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
        Schema::create('images', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->string('path')->unique();
            $table->string('hash')->unique();

            $table->index('hash');
        });

        Schema::create('image_relations', function (Blueprint $table) {
            $table->char('image_id', 26)->index();
            $table->integer('imageable_id')->index();
            $table->string('imageable_type')->index();

            $table->foreign('image_id')->references('id')->on('images')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('covers');
    }
};
