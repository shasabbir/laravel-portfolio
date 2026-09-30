<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInboxTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_messages_are_saved_and_visible_only_in_authenticated_inbox(): void
    {
        config(['mail.contact.enabled' => false]);
        $this->get('/admin/messages')->assertRedirect('/login');
        $this->post('/contact', ['name' => 'Visitor', 'email' => 'visitor@example.com', 'message' => 'Hi'])
            ->assertSessionHasNoErrors()->assertRedirect(route('contact.show'));
        $this->assertDatabaseHas('contact_submissions', ['message' => 'Hi', 'email' => 'visitor@example.com']);
        $this->get('/contact')->assertDontSee('visitor@example.com');
        $this->actingAs(User::factory()->create())->get('/admin/messages')->assertOk()->assertSee('Visitor')->assertSee('Hi');
        $this->post('/contact', ['name' => 'Admin test', 'email' => 'test@example.com', 'message' => '<script>alert(1)</script>'])
            ->assertSessionHasNoErrors();
        $this->get('/admin/messages')->assertOk()->assertSeeInOrder(['Admin test', 'Visitor'])
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)->assertDontSee('<script>alert(1)</script>', false);
    }
}
