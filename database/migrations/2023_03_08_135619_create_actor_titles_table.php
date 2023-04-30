<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('actor_titles', function (Blueprint $table) {
            $table->bigInteger('actor_id')->unsigned();
            $table->bigInteger('title_id')->unsigned();

            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('title_id')->references('id')->on('titles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actor_titles');
    }
};
