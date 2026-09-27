<?php

namespace Tests\Feature;

use App\Models\AboutMedia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AboutMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_icons_and_entry_images_can_be_uploaded_and_replaced(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create());
        $keys = AboutMedia::imageKeys();
        $this->assertGreaterThan(6, count($keys));
        foreach ($keys as $key) {
            $this->put('/admin/about-media', [
                '_editor' => $key,
                $key => UploadedFile::fake()->createWithContent('icon.jpg', file_get_contents(public_path('images/nuhash.jpg'))),
            ])->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-'.$key);
            $this->get(route('about.media', $key))->assertOk();
            $this->get('/about')->assertOk()->assertSee(route('about.media', $key));
        }
        $original = AboutMedia::findOrFail(1)->images;
        $key = $keys[0];
        $this->put('/admin/about-media', [$key => UploadedFile::fake()->create('bad.txt', 1, 'text/plain')])
            ->assertSessionHasErrors($key);
        $this->assertSame($original, AboutMedia::findOrFail(1)->images);
        $this->put('/admin/about-media', [$key => UploadedFile::fake()->createWithContent('new.jpg', file_get_contents(public_path('images/nuhash.jpg')))])
            ->assertSessionHasNoErrors();
        Storage::disk('local')->assertMissing($original[$key]);
        $this->assertSame($original[$keys[1]], AboutMedia::findOrFail(1)->imagePath($keys[1]));
        $content = \App\Models\AboutContent::findOrFail(1);
        $entries = array_reverse($content->educations);
        $imageKey = 'educations_'.$entries[0]['media_id'];
        $path = AboutMedia::findOrFail(1)->imagePath($imageKey);
        $this->put('/admin/about-content', ['section' => 'educations', 'educations' => $entries])->assertSessionHasNoErrors();
        $this->assertSame($imageKey, 'educations_'.$content->fresh()->educations[0]['media_id']);
        $this->assertSame($path, AboutMedia::findOrFail(1)->imagePath($imageKey));
        auth()->logout();
        $this->get('/about')->assertOk()->assertDontSee('Edit institution image');
        $this->put('/admin/about-media', [])->assertRedirect('/login');
        $this->get('/about/media/unknown-image')->assertNotFound();
    }

    public function test_inline_upload_returns_to_about_and_keeps_other_media(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create())->from('/about')->put('/admin/about-media', [
            '_editor' => 'portrait',
            'portrait' => UploadedFile::fake()->createWithContent('portrait.jpg', file_get_contents(public_path('images/nuhash.jpg'))),
        ])->assertSessionHasNoErrors()->assertRedirect(route('about').'#edit-portrait');
        $media = AboutMedia::findOrFail(1);
        Storage::disk('local')->assertExists($media->portrait);
        $this->assertNull($media->resume);
        $this->assertNull($media->research);
        $this->from('/about')->put('/admin/about-media', [
            '_editor' => 'resume', 'resume' => UploadedFile::fake()->create('bad.txt', 1, 'text/plain'),
        ])->assertSessionHasErrors('resume')->assertRedirect('/about');
        $this->get('/about')->assertOk()->assertSee('id="edit-resume"', false);
    }

    public function test_guests_cannot_manage_media(): void
    {
        $this->get('/admin/about-media')->assertRedirect('/login');
        $this->put('/admin/about-media')->assertRedirect('/login');
    }

    public function test_admin_can_upload_replace_and_download_media(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create());
        $this->get('/admin/about-media')->assertRedirect(route('about').'#edit-portrait');
        $this->put('/admin/about-media', [
            'portrait' => UploadedFile::fake()->createWithContent('portrait.jpg', file_get_contents(public_path('images/nuhash.jpg'))),
            'research' => UploadedFile::fake()->createWithContent('research.png', file_get_contents(public_path('images/neurodegeneration-illustration.png'))),
            'resume' => UploadedFile::fake()->create('resume.pdf', 10, 'application/pdf'),
        ])->assertSessionHasNoErrors()->assertRedirect();
        $original = AboutMedia::findOrFail(1);
        foreach (['portrait', 'research', 'resume'] as $kind) {
            Storage::disk('local')->assertExists($original->$kind);
        }
        $this->get('/about')->assertOk()->assertSee(route('about.media', 'portrait'));
        $this->get('/about/media/portrait')->assertOk();
        $this->get('/about/media/resume')->assertDownload('Gazi_Salah_Uddin_Nuhash_Resume.pdf');
        $this->put('/admin/about-media', [
            'portrait' => UploadedFile::fake()->createWithContent('replacement.png', file_get_contents(public_path('images/neurodegeneration-illustration.png'))),
        ])->assertSessionHasNoErrors();
        $updated = $original->fresh();
        Storage::disk('local')->assertMissing($original->portrait);
        Storage::disk('local')->assertExists($updated->portrait);
        $this->assertSame($original->resume, $updated->resume);
        $this->assertSame($original->research, $updated->research);
        $this->put('/admin/about-media', [])->assertSessionHasNoErrors();
        $this->assertSame($updated->portrait, $updated->fresh()->portrait);
    }

    public function test_invalid_and_oversized_uploads_are_rejected(): void
    {
        Storage::fake('local');
        $this->actingAs(User::factory()->create())->put('/admin/about-media', [
            'portrait' => UploadedFile::fake()->create('script.svg', 1, 'image/svg+xml'),
            'research' => UploadedFile::fake()->createWithContent('large.jpg', file_get_contents(public_path('images/nuhash.jpg')))->size(5121),
            'resume' => UploadedFile::fake()->create('resume.txt', 1, 'text/plain'),
        ])->assertSessionHasErrors(['portrait', 'research', 'resume']);
        $this->assertDatabaseCount('about_media', 0);
        $this->assertEmpty(Storage::disk('local')->allFiles());
    }

    public function test_public_media_defaults_and_unknown_files(): void
    {
        $this->get('/about/media/portrait')->assertOk();
        $this->get('/about/media/research')->assertOk();
        $this->get('/about/media/unknown')->assertNotFound();
        AboutMedia::create(['id' => 1, 'portrait' => 'about/missing.jpg']);
        $this->get('/about/media/portrait')->assertNotFound();
    }
}
