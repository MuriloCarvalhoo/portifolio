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
        Schema::create('title_genres', function (Blueprint $table) {
            $table->bigInteger('title_id')->unsigned();
            $table->bigInteger('genre_id')->unsigned();

            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('title_genres');
    }
};
