<?php

namespace Tests\Feature;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicationPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_pdf_opens_publicly_and_is_retained_on_text_update(): void
    {
        Storage::fake('public');
        $data = ['title' => 'Paper', 'authors' => 'Author', 'venue' => 'Journal', 'year' => '2026', 'publication_type' => 'Journal'];
        $this->actingAs(User::factory()->create())->post('/publications', $data + ['pdf' => UploadedFile::fake()->create('paper.pdf', 10, 'application/pdf')])->assertSessionHasNoErrors();
        $publication = Publication::firstOrFail();
        $path = $publication->pdf;
        Storage::disk('public')->assertExists($path);
        $this->put(route('publications.update', $publication), $data + ['pdf' => null])->assertSessionHasNoErrors();
        $this->assertSame($path, $publication->fresh()->pdf);
        auth()->logout();
        $this->get(route('publications.pdf', $publication))->assertOk()->assertHeader('Content-Type', 'application/pdf')
            ->assertHeader('Content-Disposition', 'inline; filename="publication-'.$publication->id.'.pdf"');
        $this->get('/publications')->assertSee(route('publications.pdf', $publication));
        $publication->update(['pdf' => 'http://localhost/storage/'.$path]);
        $this->get(route('publications.pdf', $publication))->assertOk();
        Storage::disk('public')->delete($path);
        $this->get(route('publications.pdf', $publication))->assertNotFound();
        $publication->update(['pdf' => 'publications/../../.env']);
        $this->get(route('publications.pdf', $publication))->assertNotFound();
    }
}
