<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'slug' => 'welcome-to-the-blog',
            'title' => 'Welcome to the Blog',
            'excerpt' => 'This is a starter post to verify Laravel migration from Next.js',
            'image_url' => 'https://picsum.photos/800/400',
            'image_hint' => 'sample image',
            'content' => 'Hello world! This is a sample post migrated to Laravel.',
            'author_name' => 'GAZI SALAH UDDIN NUHASH',
            'author_avatar' => 'https://i.postimg.cc/50FkXX3x/nuhash.jpg',
            'tags' => ['New'],
            'date' => now(),
        ]);
    }
}
