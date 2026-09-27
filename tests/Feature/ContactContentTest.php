<?php

namespace Tests\Feature;

use App\Models\ContactContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_map_uses_the_embed_endpoint_and_saved_location(): void
    {
        ContactContent::create(['id' => 1, 'values' => ['map_query' => 'Dhaka & nearby', 'map_title' => 'Our location']]);
        $this->get('/contact')->assertOk()
            ->assertSee('src="https://maps.google.com/maps?q=Dhaka%20%26%20nearby&amp;z=15&amp;output=embed"', false)
            ->assertSee('title="Our location"', false)
            ->assertSee('Open in Google Maps');
    }

    public function test_guests_can_view_but_cannot_edit_contact_content(): void
    {
        $this->get('/contact')->assertOk()->assertSee('Send a Message')->assertDontSee('id="edit-contact-info"', false);
        $this->put('/admin/contact-content', [])->assertRedirect('/login');
    }

    public function test_sections_save_independently_and_unsafe_text_is_escaped(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/contact')->assertOk()->assertSee('id="edit-contact-info"', false)->assertSee('id="edit-contact-form"', false);
        foreach (ContactContent::GROUPS as $group => $schema) {
            $values = array_intersect_key(ContactContent::DEFAULTS, array_flip($schema['fields']));
            $first = $group === 'contact-map' ? 'map_query' : $schema['fields'][0];
            $values[$first] = 'Updated '.$values[$first];
            $this->put('/admin/contact-content', compact('group', 'values'))->assertSessionHasNoErrors()
                ->assertRedirect(route('contact.show').'#edit-'.$group);
        }
        $this->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['intro' => '<script>alert(1)</script>']])->assertSessionHasNoErrors();
        $this->assertSame('Updated Send a Message', ContactContent::findOrFail(1)->value('form_heading'));
        $this->get('/contact')->assertOk()->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)->assertDontSee('<script>alert(1)</script>', false);
        $this->from('/contact')->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['email' => 'invalid']])->assertSessionHasErrors('values.email');
        $this->get('/contact')->assertOk()->assertSee('invalid');
        $this->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['form_heading' => 'wrong group']])->assertSessionHasErrors('values');
    }

    public function test_images_can_be_replaced_and_invalid_uploads_rejected(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create());
        foreach (['location', 'email', 'hours'] as $key) {
            $this->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['intro' => 'Contact us'],
                'uploads' => [$key => UploadedFile::fake()->createWithContent('icon.jpg', file_get_contents(public_path('images/nuhash.jpg')))]])
                ->assertSessionHasNoErrors();
            $this->get(route('contact.media', $key))->assertOk();
        }
        $old = ContactContent::findOrFail(1)->images;
        $this->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['intro' => 'Contact us'],
            'uploads' => ['location' => UploadedFile::fake()->createWithContent('new.jpg', file_get_contents(public_path('images/nuhash.jpg')))]])->assertSessionHasNoErrors();
        Storage::disk('local')->assertMissing($old['location']);
        $this->assertSame($old['email'], ContactContent::findOrFail(1)->images['email']);
        $this->put('/admin/contact-content', ['group' => 'contact-info', 'values' => ['intro' => 'Contact us'],
            'uploads' => ['hours' => UploadedFile::fake()->create('bad.txt', 1, 'text/plain')]])->assertSessionHasErrors('uploads.hours');
        $this->get('/contact/media/unknown')->assertNotFound();
    }

    public function test_public_submission_still_saves_and_uses_configured_success_message(): void
    {
        config(['mail.contact.enabled' => false]);
        ContactContent::create(['id' => 1, 'values' => ['success_message' => 'Thank you for reaching out.']]);
        $this->post('/contact', ['name' => 'Test Person', 'email' => 'test@example.com', 'message' => 'A valid contact message.'])
            ->assertRedirect(route('contact.show'))->assertSessionHas('status', 'Thank you for reaching out.');
        $this->assertDatabaseHas('contact_submissions', ['email' => 'test@example.com']);
        $this->post('/contact', ['name' => '', 'email' => 'invalid', 'message' => ''])->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
