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
        Schema::create('cars_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('name');
            $table->string('link')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('brand_id');
            $table->index('link');
        });

        Schema::create('cars_generations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->nullable()->constrained('cars_models')->nullOnDelete();
            $table->string('name');
            $table->string('link')->unique();
            $table->enum('type', [
                'sedan', 'hatchback_3_doors', 'hatchback_5_doors',
                'liftback', 'allroad_5_doors', 'wagon',
                'coupe', 'cabriolet'
            ])->index();
            $table->string('other_names')->nullable();
            $table->string('price_text_ru');
            $table->string('price_text_cn');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('model_id');
            $table->index('link');
        });

        Schema::create('cars_modifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generation_id')->constrained('cars_generations')->cascadeOnDelete();
            $table->string('name');

            $table->index('generation_id');
        });

        Schema::create('cars_specs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
        });

        Schema::create('cars_specs_entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spec_id')->constrained('cars_specs')->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('name');

            $table->index('spec_id');
        });

        Schema::create('cars_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
        });

        Schema::create('cars_equipments_entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('cars_equipments')->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('name');

            $table->index('equipment_id');
        });

        Schema::create('cars_modification_spec_entity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modification_id')->constrained('cars_modifications')->cascadeOnDelete();
            $table->foreignId('spec_entity_id')->constrained('cars_specs_entities')->cascadeOnDelete();
            $table->string('value');

            $table->index('modification_id');
            $table->index('spec_entity_id');
        });

        Schema::create('cars_modification_equipment_entity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modification_id')->constrained('cars_modifications')->cascadeOnDelete();
            $table->foreignId('equipment_entity_id')->constrained('cars_equipments_entities')->cascadeOnDelete();

            $table->index('modification_id');
            $table->index('equipment_entity_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars_models');
        Schema::dropIfExists('cars_generations');
    }
};
