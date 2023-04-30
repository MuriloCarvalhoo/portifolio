<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name'], 'professions_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
