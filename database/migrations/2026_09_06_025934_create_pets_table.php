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
    Schema::create('pets', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type'); // Dog or Cat
        $table->integer('age_years');
        $table->decimal('weight_lbs', 5, 2);
        $table->string('breed');
        $table->enum('gender', ['Male', 'Female']);
        $table->string('location');
        $table->text('about');
        
        // Personality (1-5 Scale)
        $table->integer('social_level')->default(3);
        $table->integer('talkative_level')->default(3);
        $table->integer('active_level')->default(3);
        
        // Attributes (Booleans)
        $table->boolean('is_apartment_friendly')->default(false);
        $table->boolean('is_studio_friendly')->default(false);
        $table->boolean('is_potty_trained')->default(false);
        $table->boolean('is_leash_trained')->default(false);
        $table->boolean('is_people_friendly')->default(false);
        $table->boolean('is_dog_friendly')->default(false);
        $table->boolean('is_vaccinated')->default(false);
        $table->boolean('is_healthy')->default(false);
        
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
