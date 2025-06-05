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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic Info
            $table->text('bio')->nullable();
            
            $table->string('education')->nullable();
            $table->string('age')->nullable();

            // Relationship goals (aligns with preferences)
            $table->enum('relationship_goal', ['friendship', 'dating', 'long_term', 'casual', 'unsure'])->nullable();

            // Gender & orientation (aligns with preferences)
            $table->enum('gender', ['male', 'female', 'non-binary', 'other'])->nullable();

            // Location info (aligns with preferences)
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->point('location')->nullable(); // for geospatial search

            // Physical attributes (aligns with preferences)
            $table->integer('height')->nullable(); // store as cm
            $table->enum('skin_color', ['light', 'medium', 'dark', 'other'])->nullable();
            $table->enum('body_type', ['slim', 'athletic', 'average', 'curvy', 'muscular', 'plus_size_curvy', 'plus_size_solid', 'other'])->nullable();

            // Lifestyle attributes (aligns with preferences)
            $table->enum('drinking', ['dont_drink', 'on_special_occasions', 'weekends', 'everyday'])->nullable();
            $table->enum('smoking', ['dont_smoke', 'smoker_when_drinking', 'trying_to_quit', 'regular_smoker'])->nullable();
            $table->enum('exercise', ['every_day', 'often', 'sometimes', 'never'])->nullable();

            // Religion & politics (aligns with preferences)
            $table->enum('religion', ['christian', 'muslim', 'hindu', 'buddhist', 'atheist', 'other'])->nullable();
            $table->enum('politics', ['liberal', 'conservative', 'moderate', 'apolitical', 'other'])->nullable();

            // Style (aligns with preferences)
            $table->enum('style', ['casual', 'athletic', 'business', 'bohemian', 'alternative', 'preppy', 'vintage', 'designer', 'other'])->nullable();

            // Tattoos & piercings (aligns with preferences)
            $table->boolean('has_tattoos')->default(false);
            $table->boolean('has_piercings')->default(false);

            // Interests
            $table->json('interests')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
