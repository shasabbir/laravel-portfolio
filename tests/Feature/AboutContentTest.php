<?php

namespace Tests\Feature;

use App\Models\AboutContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_inline_editors_are_only_visible_when_signed_in_and_save_one_section(): void
    {
        $this->get('/about')->assertOk()->assertDontSee('id="edit-experiences"', false)->assertDontSee('id="edit-portrait"', false);
        $this->actingAs(User::factory()->create());
        $this->get('/about')->assertOk()->assertSee('id="edit-experiences"', false)->assertSee('id="edit-educations"', false)
            ->assertSee('id="edit-portrait"', false)->assertSee('id="edit-research"', false)->assertSee('id="edit-resume"', false);
        $original = AboutContent::findOrFail(1);
        $this->from('/about')->put('/admin/about-content', [
            'section' => 'experiences',
            'experiences' => [['title' => 'Inline role', 'period' => '2026', 'organization' => 'Example']],
            'additional_experience' => 'Inline note',
        ])->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-experiences');
        $this->assertSame($original->educations, $original->fresh()->educations);
        $this->from('/about')->put('/admin/about-content', ['section' => 'educations'])
            ->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-educations');
        $this->assertSame([], $original->fresh()->educations);
        $this->assertSame('Inline role', $original->fresh()->experiences[0]['title']);
        $this->assertSame('Inline note', $original->fresh()->additional_experience);
        $this->from('/about')->put('/admin/about-content', [
            'section' => 'experiences', 'experiences' => [['title' => 'Retain my input']],
        ])->assertSessionHasErrors('experiences.0.period')->assertRedirect('/about');
        $this->get('/about')->assertOk()->assertSee('Retain my input');
    }

    public function test_defaults_are_preserved_and_guests_cannot_edit(): void
    {
        $content = AboutContent::findOrFail(1);
        $this->assertCount(4, $content->experiences);
        $this->assertCount(2, $content->educations);
        $this->get('/about')->assertOk()->assertSee('Graduate Research Assistant')->assertSee('M.S. in Biotechnology');
        $this->get('/admin/about-content')->assertRedirect('/login');
        $this->put('/admin/about-content', [])->assertRedirect('/login');
        $this->assertCount(4, $content->fresh()->experiences);
    }

    public function test_admin_can_edit_add_reorder_and_remove_content(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/admin/about-content')->assertRedirect(route('about').'#edit-experiences');
        $content = AboutContent::findOrFail(1);
        $experiences = array_reverse($content->experiences);
        $experiences[0]['title'] = 'Updated research role';
        $experiences[] = ['period' => '2027', 'title' => 'New role', 'organization' => 'New institution', 'description' => '<script>alert(1)</script>'];
        $educations = [$content->educations[1]];
        $educations[0]['badge'] = 'UNI';
        $educations[0]['color'] = '#112233';
        $this->put('/admin/about-content', compact('experiences', 'educations') + ['additional_experience' => 'Updated note'])
            ->assertRedirect(route('about'))->assertSessionHasNoErrors();
        $updated = $content->fresh();
        $this->assertCount(5, $updated->experiences);
        $this->assertCount(1, $updated->educations);
        $this->assertSame('Updated research role', $updated->experiences[0]['title']);
        $this->get('/about')->assertOk()->assertSeeInOrder(['Updated research role', 'New role'])
            ->assertSee('Updated note')->assertSee('UNI')->assertSee('#112233')
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)->assertDontSee('<script>alert(1)</script>', false)
            ->assertDontSee('M.S. in Biotechnology');
        $this->put('/admin/about-content', [])->assertSessionHasNoErrors();
        $this->assertSame([], $content->fresh()->experiences);
        $this->assertSame([], $content->fresh()->educations);
        $this->get('/about')->assertOk()->assertDontSee('Updated research role');
    }

    public function test_invalid_content_is_rejected_without_changing_existing_data(): void
    {
        $before = AboutContent::findOrFail(1)->toArray();
        $this->actingAs(User::factory()->create())->from('/admin/about-content')->put('/admin/about-content', [
            'experiences' => [['title' => '', 'period' => '2026', 'organization' => 'Example']],
            'educations' => [['title' => 'Degree', 'period' => '2026', 'organization' => 'University', 'color' => 'red;display:none']],
        ])->assertSessionHasErrors(['experiences.0.title', 'educations.0.color']);
        $this->assertSame($before, AboutContent::findOrFail(1)->toArray());
        $this->get('/admin/about-content')->assertRedirect(route('about').'#edit-experiences');
    }
}
