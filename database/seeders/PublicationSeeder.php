<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publication;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publication::create([
            'title' => 'Sample Publication',
            'authors' => 'N. Gazi',
            'venue' => 'Journal of Examples',
            'year' => '2025',
            'publication_type' => 'Journal',
            'doi' => null,
            'url' => null,
            'pdf' => null,
            'abstract' => 'This is a sample publication entry to test the system.',
            'citation' => [
                'apa' => 'Gazi, N. (2025). Sample Publication. Journal of Examples.',
            ],
        ]);
    }
}
