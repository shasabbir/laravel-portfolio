<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_media', function (Blueprint $table) {
            $table->id();
            $table->string('portrait')->nullable();
            $table->string('research')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_media');
    }
};
