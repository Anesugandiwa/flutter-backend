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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('looking_for', ['friendship', 'dating', 'long_term', 'casual', 'unsure'])->nullable();
    
            // Gender preference (aligned with profile)
            $table->enum('preferred_gender', ['male', 'female', 'non-binary', 'other'])->nullable();
    
            // Location preferences (aligned with profile)
            $table->string('preferred_country')->nullable();
            $table->string('preferred_state')->nullable();
            $table->string('preferred_city')->nullable();
            $table->integer('preferred_distance_km')->default(50);
    
            // Age and height range (aligned with profile)
            $table->integer('preferred_age_min')->default(18);
            $table->integer('preferred_age_max')->default(99);
            $table->integer('preferred_height_min')->nullable();
            $table->integer('preferred_height_max')->nullable();
            
            // Physical attributes (aligned with profile)
            $table->enum('preferred_skin_color', ['light', 'medium', 'dark', 'any'])->nullable();
    
            $table->enum('preferred_body_type', ['slim', 'athletic', 'average', 'curvy', 'muscular', 'plus_size_curvy', 'plus_size_solid', 'any'])->nullable();
    

    
            // Lifestyle preferences (aligned with profile)
            $table->enum('preferred_drinking_habit', ['dont_drink', 'on_special_occasions', 'weekends', 'everyday', 'any'])->nullable();
    
            $table->enum('preferred_smoking_habit', ['dont_smoke', 'smoker_when_drinking', 'trying_to_quit', 'any'])->nullable();
    
            $table->enum('preferred_exercise_habit', ['every_day', 'often', 'sometimes', 'any'])->nullable();
    
            // Education preferences (aligned with profile)
            $table->enum('preferred_education_level', ['bsc_degree', 'at_uni', 'high_school', 'diploma', 'other', 'any'])->nullable();
    
            // Love language preferences
            $table->enum('preferred_love_language', ['touch', 'gifts', 'compliments', 'thoughtful_gestures', 'time_together', 'any'])->nullable();
    
            // Religion preferences (aligned with profile)
            $table->enum('preferred_religion', ['christian', 'muslim', 'hindu', 'buddhist', 'atheist', 'other', 'any'])->nullable();
    
            // Politics preferences (aligned with profile)
            $table->enum('preferred_politics', ['liberal', 'conservative', 'moderate', 'apolitical', 'any'])->nullable();
    
            // Style preferences (aligned with profile)
            $table->enum('preferred_style', ['casual', 'athletic', 'business', 'bohemian', 'alternative', 'preppy', 'vintage', 'designer', 'any'])->nullable();
    
            // Tattoos/piercings preferences
            $table->enum('preferred_tattoos', ['yes', 'no', 'dont_care'])->nullable();
            $table->enum('preferred_piercings', ['yes', 'no', 'dont_care'])->nullable();
    
            // Relationship dealbreakers
            $table->boolean('must_have_same_religion')->default(false);
            $table->boolean('must_have_same_politics')->default(false);
            $table->boolean('must_not_smoke')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
