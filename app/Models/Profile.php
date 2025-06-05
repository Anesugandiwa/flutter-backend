<?php

namespace App\Models;
use App\Mpodels\User;
use App\Mpodels\Preference;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
        protected $fillable = [
            'user_id',
            'bio',
            'age',
            'education',
            'date_of_birth',
            'relationship_goal',
            'gender',
            'country',
            'state',
            'city',
            'location',
            'height',
            'skin_color',
            'body_type',
            'drinking',
            'smoking',
            'exercise',
            'religion',
            'politics',
            'style',
            'has_tattoos',
            'has_piercings',
            'interests',
        ];
        protected $casts = [
            'interests' => 'array',
            'has_tattoos' => 'boolean',
            'has_piercings' => 'boolean',
        ];

        public function user(){
            return $this->belongsTo(User::class);
        }

}
