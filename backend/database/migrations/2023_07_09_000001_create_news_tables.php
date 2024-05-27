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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->unique();
            $table->boolean('status')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords', 100)->nullable();

            $table->index('link');
        });

        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('news_categories')->nullOnDelete();
            $table->string('name');
            $table->string('link')->unique();
            $table->text('text')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('status')->default(0);
            $table->json('tags')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords', 100)->nullable();
            $table->timestamps();

            $table->index('category_id');
            $table->index('link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
        Schema::dropIfExists('news_categories');
    }
};
