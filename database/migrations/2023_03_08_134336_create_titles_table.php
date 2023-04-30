<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tconst')->unique();
            $table->unsignedBigInteger('type_id');
            $table->longText('primary');
            $table->longText('original');
            $table->boolean('is_adult')->default(false);
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->string('runtime_minutes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')->references('id')->on('type_titles');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('titles');
    }
};
