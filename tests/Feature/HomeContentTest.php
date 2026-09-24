<?php

namespace Tests\Feature;

use App\Models\HomeContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomeContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_defaults_and_guest_authorization(): void
    {
        $this->get('/')->assertOk()->assertSee('Life Sciences Researcher')->assertDontSee('Edit homepage, images');
        $this->get('/')->assertDontSee('<details data-inline-edit', false);
        $this->get('/admin/home-content')->assertRedirect('/login');
        $this->put('/admin/home-content', ['field' => 'home_23', 'value' => 'Changed'])->assertRedirect('/login');
        $this->assertDatabaseCount('home_content', 0);
    }

    public function test_each_section_has_an_inline_editor_and_returns_to_it_after_save(): void
    {
        $this->actingAs(User::factory()->create());
        $page = $this->get('/')->assertOk();
        foreach (HomeContent::sections() as $section => $definition) {
            if ($section === 'header') {
                $page->assertDontSee('id="edit-header"', false);
                continue;
            }
            $page->assertSee('id="edit-'.$section.'"', false);
        }
        $this->from('/')->put('/admin/home-content', [
            '_editor' => 'membership', 'field' => 'membership_heading', 'value' => 'Updated membership',
        ])->assertSessionHasNoErrors()->assertRedirect(route('home').'#edit-membership');
        $this->get('/')->assertSee('Updated membership')->assertSee('Homepage updated.');
        $this->from('/')->put('/admin/home-content', [
            '_editor' => 'hero', 'field' => 'publications_button_url', 'value' => 'javascript:alert(1)',
        ])->assertRedirect('/')->assertSessionHasErrors('value');
        $this->get('/')->assertOk()->assertSee('Enter an http(s) URL');
    }

    public function test_text_is_saved_escaped_and_other_fields_are_preserved(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/admin/home-content')->assertRedirect(route('home').'#edit-hero');
        $this->get('/')->assertOk()->assertSee('Hero portrait')->assertSee('id="edit-hero"', false);
        foreach (['home_23' => 'New Name', 'home_24' => '<script>alert(1)</script>'] as $key => $value) {
            $this->put('/admin/home-content', ['field' => $key, 'value' => $value])->assertSessionHasNoErrors();
        }
        $this->get('/')->assertOk()->assertSee('New Name')->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
        $this->put('/admin/home-content', ['field' => 'home_24', 'reset' => 1])->assertSessionHasNoErrors();
        $this->get('/')->assertSee('New Name')->assertSee('Life Sciences Researcher');
    }

    public function test_upload_replace_reset_and_shared_logo(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create());
        $upload = fn () => UploadedFile::fake()->createWithContent('logo.jpg', file_get_contents(public_path('images/nuhash.jpg')));
        $this->put('/admin/home-content', ['field' => 'header_1', 'upload' => $upload()])->assertSessionHasNoErrors();
        $old = HomeContent::findOrFail(1)->values['header_1_file'];
        $this->get('/home/media/header_1')->assertOk();
        $this->get('/')->assertOk()->assertSee('/home/media/header_1');
        $this->get('/about')->assertOk()->assertSee('/home/media/header_1');
        $this->put('/admin/home-content', ['field' => 'header_1', 'value' => '/home/media/header_1'])->assertSessionHasNoErrors();
        Storage::disk('local')->assertExists($old);
        $this->put('/admin/home-content', ['field' => 'header_1', 'upload' => $upload()])->assertSessionHasNoErrors();
        Storage::disk('local')->assertMissing($old);
        $new = HomeContent::findOrFail(1)->values['header_1_file'];
        $this->put('/admin/home-content', ['field' => 'header_1', 'reset' => 1])->assertSessionHasNoErrors();
        Storage::disk('local')->assertMissing($new);
        $this->get('/home/media/header_1')->assertNotFound();
    }

    public function test_invalid_fields_urls_and_uploads_are_rejected(): void
    {
        $this->actingAs(User::factory()->create());
        $this->put('/admin/home-content', ['field' => '../invalid'])->assertSessionHasErrors('field');
        foreach (['javascript:alert(1)', '//evil.example', '/\\evil.example'] as $value) {
            $this->put('/admin/home-content', ['field' => 'header_9', 'value' => $value])->assertSessionHasErrors('value');
        }
        $this->put('/admin/home-content', ['field' => 'brand_logo', 'upload' => UploadedFile::fake()->create('bad.svg', 1, 'image/svg+xml')])->assertSessionHasErrors('upload');
        $this->assertDatabaseCount('home_content', 0);
    }

    public function test_full_membership_paragraph_preserves_existing_text_and_formats_bold_safely(): void
    {
        HomeContent::create(['id' => 1, 'values' => [
            'home_54' => 'I am part of', 'home_55' => 'My Society', 'home_56' => ', a research community.',
        ]]);
        $this->actingAs(User::factory()->create());
        $this->get('/')->assertOk()->assertSee('I am part of <strong>My Society</strong>, a research community.', false)
            ->assertSee('name="field" value="membership_paragraph"', false)
            ->assertDontSee('name="field" value="home_54"', false)
            ->assertDontSee('name="field" value="home_55"', false)
            ->assertDontSee('name="field" value="home_56"', false);
        $this->put('/admin/home-content', [
            '_editor' => 'membership', 'field' => 'membership_paragraph',
            'value' => 'A complete **bold paragraph** with <img src=x onerror=alert(1)>.',
        ])->assertSessionHasNoErrors();
        $this->get('/')->assertOk()->assertSee('A complete <strong>bold paragraph</strong>', false)
            ->assertDontSee('<img src=x onerror=alert(1)>', false)
            ->assertSee('&lt;img src=x onerror=alert(1)&gt;', false);
        $this->put('/admin/home-content', ['field' => 'membership_paragraph', 'reset' => 1])->assertSessionHasNoErrors();
        $this->assertStringContainsString('International Society', HomeContent::find(1)->value('membership_paragraph'));
    }

    public function test_membership_tiles_and_highlights_are_combined_fields(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/')->assertOk()->assertSee('Global Community')
            ->assertSee('name="field" value="membership_community"', false)
            ->assertDontSee('name="field" value="home_63"', false)
            ->assertDontSee('name="field" value="home_64"', false)
            ->assertDontSee('name="field" value="home_57"', false);
        $this->put('/admin/home-content', [
            'field' => 'membership_benefits', 'value' => "First highlight\nSecond **highlight**",
        ])->assertSessionHasNoErrors();
        $this->get('/')->assertOk()->assertSee('First highlight')->assertSee('Second <strong>highlight</strong>', false);
    }
}
