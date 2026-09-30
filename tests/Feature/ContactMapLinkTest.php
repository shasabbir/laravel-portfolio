<?php

namespace Tests\Feature;

use App\Models\ContactContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContactMapLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_location_share_and_embed_links_update_the_map(): void
    {
        $this->actingAs(User::factory()->create());
        Http::preventStrayRequests();
        Http::fake(['https://maps.app.goo.gl/example' => Http::response('', 302, ['Location' => 'https://www.google.com/maps/place/Dhaka/@23.8,90.4,15z/data=!3d23.81!4d90.41'])]);
        $links = [
            'https://www.google.com/maps?q=Dhaka' => 'https://maps.google.com/maps?q=Dhaka&z=15&output=embed',
            'https://www.google.com/maps/place/New+York/' => 'https://maps.google.com/maps?q=New%20York&z=15&output=embed',
            'https://maps.app.goo.gl/example' => 'https://maps.google.com/maps?q=23.81%2C90.41&z=15&output=embed',
            'https://www.google.com/maps/embed?pb=!1m18!1m12' => 'https://www.google.com/maps/embed?pb=!1m18!1m12',
        ];
        foreach ($links as $link => $expected) {
            $this->put('/admin/contact-content', ['group' => 'contact-map', 'values' => ['map_url' => $link]])
                ->assertSessionHasNoErrors()->assertRedirect(route('contact.show').'#edit-contact-map');
            $this->assertSame($expected, ContactContent::findOrFail(1)->mapEmbedUrl());
            $this->get('/contact')->assertOk()->assertSee('src="'.e($expected).'"', false);
        }
        $this->put('/admin/contact-content', ['group' => 'contact-map', 'values' => ['map_url' => '', 'map_query' => 'Dhaka']])->assertSessionHasNoErrors();
        $this->assertSame('https://maps.google.com/maps?q=Dhaka&z=15&output=embed', ContactContent::findOrFail(1)->mapEmbedUrl());
    }

    public function test_invalid_links_and_external_redirects_are_rejected_without_changing_map(): void
    {
        $this->actingAs(User::factory()->create());
        ContactContent::create(['id' => 1, 'values' => ['map_query' => 'Original']]);
        Http::preventStrayRequests();
        Http::fake(['https://maps.app.goo.gl/unsafe' => Http::response('', 302, ['Location' => 'http://127.0.0.1/private'])]);
        foreach (['javascript:alert(1)', 'https://evil.example/maps?q=test', 'https://www.google.com.evil.example/maps?q=test', 'https://maps.app.goo.gl/unsafe', 'https://www.google.com/maps', 'https://www.google.com/maps?q[]=test'] as $link) {
            $this->from('/contact')->put('/admin/contact-content', ['group' => 'contact-map', 'values' => ['map_url' => $link]])
                ->assertSessionHasErrors('values.map_url');
            $this->assertSame('Original', ContactContent::findOrFail(1)->value('map_query'));
        }
        Http::assertSentCount(1);
    }
}
