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
        Schema::create('actor_professions', function (Blueprint $table) {
            $table->bigInteger('actor_id')->unsigned();
            $table->bigInteger('profession_id')->unsigned();

            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('profession_id')->references('id')->on('professions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_professions');
    }
};
