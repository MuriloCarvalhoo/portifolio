<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('title_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tconst');
            $table->bigInteger('title_id')->unsigned();

            $table->float('average_rating');
            $table->integer('num_votes');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('title_id')->references('id')->on('titles');

            $table->index(['tconst', 'title_id'], 'title_ratings_index');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('title_ratings');
    }
};
