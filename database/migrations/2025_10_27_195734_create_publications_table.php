<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors');
            $table->string('venue');
            $table->string('year');
            $table->string('publication_type');
            $table->string('doi')->nullable();
            $table->string('url')->nullable();
            $table->string('pdf')->nullable();
            $table->text('abstract')->nullable();
            $table->json('citation')->nullable();
            $table->timestamps();

            $table->index(['year', 'publication_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
