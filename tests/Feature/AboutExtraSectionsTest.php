<?php

namespace Tests\Feature;

use App\Models\AboutContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutExtraSectionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_defaults_and_editor_visibility(): void
    {
        $content = AboutContent::findOrFail(1);
        $this->assertCount(2, $content->methods);
        $this->assertCount(3, $content->manuscripts);
        $this->assertCount(2, $content->highlights);
        $this->get('/about')->assertOk()->assertSee('Laboratory')->assertSee('In preparation')->assertSee('KL-YES Exchange Scholar')
            ->assertDontSee('id="edit-methods"', false)->assertDontSee('id="edit-manuscripts"', false)->assertDontSee('id="edit-highlights"', false);
        $this->actingAs(User::factory()->create())->get('/about')->assertOk()
            ->assertSee('id="edit-methods"', false)->assertSee('id="edit-manuscripts"', false)->assertSee('id="edit-highlights"', false);
    }

    public function test_each_section_can_add_reorder_edit_and_clear_without_changing_other_sections(): void
    {
        $this->actingAs(User::factory()->create());
        $newEntries = [
            'methods' => ['title' => 'New methods', 'description' => 'Analysis tools', 'icon' => 'dna'],
            'manuscripts' => ['title' => 'New manuscript', 'status' => 'Published', 'authors' => 'Example Author'],
            'highlights' => ['title' => 'New highlights', 'description' => "First honor\n\nSecond honor"],
        ];
        foreach ($newEntries as $section => $entry) {
            $before = AboutContent::findOrFail(1);
            $entries = array_reverse($before->$section);
            $entries[0]['title'] = 'Updated '.$section;
            $entries[] = $entry;
            $this->from('/about')->put('/admin/about-content', ['section' => $section, $section => $entries])
                ->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-'.$section);
            $after = $before->fresh();
            $this->assertSame($entries, $after->$section);
            foreach (array_diff(array_keys(AboutContent::SECTIONS), [$section]) as $other) {
                $this->assertSame($before->$other, $after->$other);
            }
            $this->get('/about')->assertOk()->assertSeeInOrder(['Updated '.$section, $entry['title']]);
            $this->put('/admin/about-content', ['section' => $section])->assertSessionHasNoErrors();
            $this->assertSame([], $before->fresh()->$section);
            $this->get('/about')->assertOk()->assertDontSee($entry['title']);
        }
    }

    public function test_validation_retains_input_and_rejects_unsafe_icon(): void
    {
        $before = AboutContent::findOrFail(1)->toArray();
        $this->actingAs(User::factory()->create())->from('/about')->put('/admin/about-content', [
            'section' => 'methods', 'methods' => [['title' => 'Keep this title', 'description' => 'Tools', 'icon' => 'invalid']],
        ])->assertRedirect('/about')->assertSessionHasErrors('methods.0.icon');
        $this->assertSame($before, AboutContent::findOrFail(1)->toArray());
        $this->get('/about')->assertOk()->assertSee('Keep this title');
        $this->from('/about')->put('/admin/about-content', [
            'section' => 'manuscripts', 'manuscripts' => [['title' => 'Title']],
        ])->assertSessionHasErrors(['manuscripts.0.status', 'manuscripts.0.authors']);
        $this->from('/about')->put('/admin/about-content', [
            'section' => 'highlights', 'highlights' => [['title' => 'Title', 'description' => '']],
        ])->assertSessionHasErrors('highlights.0.description');
    }
}
