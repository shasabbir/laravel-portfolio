<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    private function fields(array $overrides = []): array
    {
        return array_replace([
            'title' => 'A test blog', 'excerpt' => 'Test excerpt',
            'content' => 'Test content', 'image_hint' => 'Test image',
            'image_url' => 'https://example.com/photo.jpg', 'tags' => 'Science, Research',
        ], $overrides);
    }

    private function image(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('photo.jpg', file_get_contents(public_path('images/nuhash.jpg')));
    }

    public function test_blog_lifecycle_with_uploaded_images(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $this->get('/blog/create')->assertOk();
        $this->post('/blog', $this->fields(['image_url' => '', 'image' => $this->image()]))->assertSessionHasNoErrors();
        $blog = Blog::sole();
        Storage::disk('public')->assertExists(substr($blog->image_url, strlen('/storage/')));
        $this->get('/blog')->assertOk()->assertSee($blog->title)->assertSee($blog->image_url);
        $this->get(route('blog.show', $blog))->assertOk()->assertSee('Test content')->assertSee($blog->image_url);
        $this->get(route('blog.edit', $blog))->assertOk();
        $originalImage = $blog->image_url;
        $this->put(route('blog.update', $blog), $this->fields(['title' => 'Updated title', 'image_url' => '', 'slug' => '']))->assertSessionHasNoErrors();
        $blog->refresh();
        $this->assertSame($originalImage, $blog->image_url);
        $this->assertSame('a-test-blog', $blog->slug);
        $this->put(route('blog.update', $blog), $this->fields(['image' => $this->image()]))->assertSessionHasNoErrors();
        $blog->refresh();
        $this->assertNotSame($originalImage, $blog->image_url);
        Storage::disk('public')->assertExists(substr($blog->image_url, strlen('/storage/')));
        $this->delete(route('blog.destroy', $blog))->assertRedirect('/blog');
        $this->assertDatabaseCount('blogs', 0);
        $this->get(route('blog.show', $blog))->assertNotFound();
    }

    public function test_validation_preserves_text_and_rejects_duplicate_slugs_and_invalid_images(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $this->post('/blog', $this->fields())->assertSessionHasNoErrors();
        $this->from('/blog/create')->post('/blog', $this->fields())->assertSessionHasErrors('slug');
        $this->get('/blog/create')->assertSee('value="A test blog"', false)->assertSee('Test excerpt');
        $this->post('/blog', $this->fields(['title' => 'Second blog', 'image_url' => '', 'image' => UploadedFile::fake()->create('file.txt', 1, 'text/plain')]))->assertSessionHasErrors('image');
        $this->post('/blog', $this->fields(['title' => 'Second blog', 'image_url' => '', 'image' => $this->image()->size(4097)]))->assertSessionHasErrors('image');
        $this->post('/blog', $this->fields(['title' => 'Second blog', 'image_url' => '']))->assertSessionHasErrors(['image', 'image_url']);
        $this->assertDatabaseCount('blogs', 1);
        $this->post('/blog', $this->fields(['title' => 'Second blog']))->assertSessionHasNoErrors();
        $second = Blog::where('slug', 'second-blog')->firstOrFail();
        $this->put(route('blog.update', $second), $this->fields(['slug' => 'a-test-blog']))->assertSessionHasErrors('slug');
    }

    public function test_guests_can_read_but_cannot_modify_blogs(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/blog', $this->fields())->assertSessionHasNoErrors();
        $blog = Blog::sole();
        auth()->logout();
        $this->get('/blog')->assertOk();
        $this->get(route('blog.show', $blog))->assertOk();
        $this->get('/blog/create')->assertRedirect('/login');
        $this->post('/blog', $this->fields())->assertRedirect('/login');
        $this->get(route('blog.edit', $blog))->assertRedirect('/login');
        $this->put(route('blog.update', $blog), $this->fields())->assertRedirect('/login');
        $this->delete(route('blog.destroy', $blog))->assertRedirect('/login');
        $this->assertDatabaseCount('blogs', 1);
    }
}
