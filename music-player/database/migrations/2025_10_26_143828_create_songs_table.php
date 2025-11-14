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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('artist_id');
            $table->string('album')->nullable(); //optional
            $table->integer('year')->nullable(); //optional
            $table->text('description') ->nullable(); //optional
            $table->string('file_path_track') ->nullable(); //optional
             $table->string('file_path_music_sheet') ->nullable(); //optional
            $table->integer('duration')->nullable(); // in seconds, optional
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // if songs belong to users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
