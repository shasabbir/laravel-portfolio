<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\BlogSeeder;
use Database\Seeders\PublicationSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@nuhashgazi.com'],
            [
                'name' => 'Site Admin',
                'password' => Hash::make('Nuhash25@'),
            ]
        );

        $this->call([
            BlogSeeder::class,
            PublicationSeeder::class,
        ]);
    }
}
