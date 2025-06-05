<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preferences = Preference::with('user')->get();
        return response()->json($preferences);
    }

    /**
     * Store a newly created preference in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|exists:users,phone_number',
            'looking_for' => 'nullable|in:friendship,dating,long-term relationship,casual,unsure',
            'preferred_gender' => 'nullable|in:male,female,non-binary,any',
            'preferred_country' => 'nullable|string',
            'preferred_state' => 'nullable|string',
            'preferred_city' => 'nullable|string',
            'preferred_distance_km' => 'nullable|integer',
            'preferred_age_min' => 'nullable|integer',
            'preferred_age_max' => 'nullable|integer',
            'preferred_height_min' => 'nullable|integer',
            'preferred_height_max' => 'nullable|integer',
            'preferred_skin_color' => 'nullable|in:light,medium,dark,any',
            'preferred_body_type' => 'nullable|in:slim,athletic,average,curvy,muscular,any',
            'preferred_drinking_habit' => 'nullable|in:dont_drink,on_special_occasions,weekends,everyday,any',
            'preferred_smoking_habit' => 'nullable|in:dont_smoke,smoker_when_drinking,trying_to_quit,any',
            'preferred_exercise_habit' => 'nullable|in:every_day,often,sometimes,any',
            'preferred_education_level' => 'nullable|in:bsc_degree,at_uni,high_school,diploma,other,any',
            'preferred_love_language' => 'nullable|in:touch,gifts,compliments,thoughtful_gestures,time_together,any',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user->preference) {
            return response()->json([
                'success' => false,
                'message' => 'Preference already exists for this user.',
            ], 409);
        }

        $preferenceData = $request->only([
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
        ]);

        $preferenceData['user_id'] = $user->id;

        $preference = Preference::create($preferenceData);

        return response()->json([
            'success' => true,
            'message' => 'Preference created successfully.',
            'preference' => $preference,
        ], 201);
    }

    /**
     * Display the specified preference.
     */
    public function show(string $id)
    {
        $preference = Preference::with('user')->findOrFail($id);
        return response()->json($preference);
    }

    /**
     * Update the specified preference.
     */
    public function update(Request $request, string $id)
    {
        $preference = Preference::findOrFail($id);

        $validated = $request->validate([
            'looking_for' => 'nullable|in:friendship,dating,long-term relationship,casual,unsure',
            'preferred_gender' => 'nullable|in:male,female,non-binary,any',
            'preferred_country' => 'nullable|string',
            'preferred_state' => 'nullable|string',
            'preferred_city' => 'nullable|string',
            'preferred_distance_km' => 'nullable|integer',
            'preferred_age_min' => 'nullable|integer',
            'preferred_age_max' => 'nullable|integer',
            'preferred_height_min' => 'nullable|integer',
            'preferred_height_max' => 'nullable|integer',
            'preferred_skin_color' => 'nullable|in:light,medium,dark,any',
            'preferred_body_type' => 'nullable|in:slim,athletic,average,curvy,muscular,any',
            'preferred_drinking_habit' => 'nullable|in:dont_drink,on_special_occasions,weekends,everyday,any',
            'preferred_smoking_habit' => 'nullable|in:dont_smoke,smoker_when_drinking,trying_to_quit,any',
            'preferred_exercise_habit' => 'nullable|in:every_day,often,sometimes,any',
            'preferred_education_level' => 'nullable|in:bsc_degree,at_uni,high_school,diploma,other,any',
            'preferred_love_language' => 'nullable|in:touch,gifts,compliments,thoughtful_gestures,time_together,any',
        ]);

        $preference->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Preference updated successfully.',
            'preference' => $preference,
        ]);
    }

    /**
     * Remove the specified preference.
     */
    public function destroy(string $id)
    {
        $preference = Preference::findOrFail($id);
        $preference->delete();

        return response()->json(['message' => 'Preference deleted successfully']);
    }
}
