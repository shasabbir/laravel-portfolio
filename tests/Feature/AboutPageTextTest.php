<?php

namespace Tests\Feature;

use App\Models\AboutContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTextTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_text_can_be_saved_without_changing_existing_sections(): void
    {
        $content = AboutContent::findOrFail(1);
        $this->get('/about')->assertOk()->assertSee('From molecular clues to meaningful discovery.')
            ->assertDontSee('id="edit-intro"', false);
        $this->put('/admin/about-content', ['section' => 'page_text', 'page_text' => ['hero_title' => 'Unauthorized']])
            ->assertRedirect('/login');
        $this->actingAs(User::factory()->create());
        $this->get('/about')->assertOk()->assertSee('id="edit-intro"', false)->assertSee('id="edit-profile"', false)
            ->assertDontSee('Edit page text &amp; headings', false);
        $values = array_map(fn ($value) => 'Updated '.$value, AboutContent::PAGE_TEXT);
        $values['hero_title'] = '<script>alert(1)</script>';
        foreach (AboutContent::TEXT_GROUPS as $group => $config) {
            $this->put('/admin/about-content', ['section' => 'page_text', 'text_group' => $group,
                'page_text' => array_intersect_key($values, array_flip($config['fields']))])
                ->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-'.$group);
        }
        $this->assertSame($content->experiences, $content->fresh()->experiences);
        $this->assertSame($content->educations, $content->fresh()->educations);
        $this->assertEquals($values, $content->fresh()->page_text);
        auth()->logout();
        $response = $this->get('/about')->assertOk()->assertDontSee('<script>alert(1)</script>', false);
        foreach ($values as $value) {
            $response->assertSee($value);
        }
    }

    public function test_invalid_text_retains_input_and_partial_updates_preserve_other_text(): void
    {
        $this->actingAs(User::factory()->create());
        $this->put('/admin/about-content', ['section' => 'page_text', 'text_group' => 'intro', 'page_text' => ['hero_title' => 'Custom title']])
            ->assertSessionHasNoErrors();
        $this->from('/about')->put('/admin/about-content', [
            'section' => 'page_text', 'text_group' => 'intro', 'page_text' => ['hero_title' => '', 'hero_subtitle' => 'Retained input'],
        ])->assertSessionHasErrors('page_text.hero_title');
        $this->get('/about')->assertOk()->assertSee('Retained input');
        $this->assertSame('Custom title', AboutContent::findOrFail(1)->pageText('hero_title'));
        $this->put('/admin/about-content', ['section' => 'page_text', 'text_group' => 'intro', 'page_text' => ['profile_name' => 'No']])
            ->assertSessionHasErrors('page_text');
        $this->put('/admin/about-content', ['section' => 'page_text', 'text_group' => 'profile', 'page_text' => ['profile_name' => 'New name']])
            ->assertSessionHasNoErrors();
        $this->assertSame('Custom title', AboutContent::findOrFail(1)->pageText('hero_title'));
        $this->get('/about')->assertOk()->assertSee('New name');
    }
}
