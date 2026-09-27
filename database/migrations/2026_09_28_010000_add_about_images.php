<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_media', fn (Blueprint $table) => $table->json('images')->nullable());
        $content = DB::table('about_content')->where('id', 1)->first();
        if (!$content) return;
        foreach (['educations', 'methods'] as $section) {
            $entries = json_decode($content->$section ?? '[]', true);
            foreach ($entries as &$entry) $entry['media_id'] = (string) Str::uuid();
            unset($entry);
            DB::table('about_content')->where('id', 1)->update([$section => json_encode($entries)]);
        }
    }

    public function down(): void
    {
        Schema::table('about_media', fn (Blueprint $table) => $table->dropColumn('images'));
    }
};
