<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'user_id',
        'looking_for',
        'preferred_gender',
        'preferred_country',
        'preferred_state',
        'preferred_city',
        'preferred_distance_km',
        'preferred_age_min',
        'preferred_age_max',
        'preferred_height_min',
        'preferred_height_max',
        'preferred_skin_color',
        'preferred_body_type',
        'preferred_drinking_habit',
        'preferred_smoking_habit',
        'preferred_exercise_habit',
        'preferred_education_level',
        'preferred_love_language',
        'preferred_religion',
        'preferred_politics',
        'preferred_style',
        'preferred_tattoos',
        'preferred_piercings',
        'must_have_same_religion',
        'must_have_same_politics',
        'must_not_smoke',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
