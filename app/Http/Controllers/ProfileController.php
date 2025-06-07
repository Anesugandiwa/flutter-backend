<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of profiles.
     */
    public function index()
    {
        $profiles = Profile::with('user')->get();
        return response()->json($profiles);
    }

    /**
     * Store a newly created profile.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            // 'phone_number' => 'required|string|exists:users,phone_number',

            // Basic Info
            'bio' => 'nullable|string',
            'education' => 'nullable|string',
            'age' => 'nullable|integer',

            'relationship_goal' => 'nullable|in:friendship,dating,long_term,casual,unsure',
            'gender' => 'nullable|in:male,female,non-binary,other',

            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'location' => 'nullable',

            'height' => 'nullable|integer',
            'skin_color' => 'nullable|in:light,medium,dark,other',
            'body_type' => 'nullable|in:slim,athletic,average,curvy,muscular,plus_size_curvy,plus_size_solid,other',

            'drinking' => 'nullable|in:dont_drink,on_special_occasions,weekends,everyday',
            'smoking' => 'nullable|in:dont_smoke,smoker_when_drinking,trying_to_quit,regular_smoker',
            'exercise' => 'nullable|in:every_day,often,sometimes,never',

            'religion' => 'nullable|in:christian,muslim,hindu,buddhist,atheist,other',
            'politics' => 'nullable|in:liberal,conservative,moderate,apolitical,other',

            'style' => 'nullable|in:casual,athletic,business,bohemian,alternative,preppy,vintage,designer,other',

            'has_tattoos' => 'nullable|boolean',
            'has_piercings' => 'nullable|boolean',

            'interests' => 'nullable|array',
        ]);

        // Find user by phone number
        // $user = User::where('phone_number', $validated['phone_number'])->first();

        // Create profile
        $profile = new Profile();
        $profile->user_id = null;
        // $user->id

        // Fill fields
        $fields = [
            'bio', 'education', 'age', 'relationship_goal', 'gender', 'country', 'state', 'city', 'location',
            'height', 'skin_color', 'body_type', 'drinking', 'smoking', 'exercise', 'religion', 'politics', 'style',
            'has_tattoos', 'has_piercings'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $profile->{$field} = $request->{$field};
            }
        }

        // Interests
        if ($request->has('interests')) {
            $profile->interests = json_encode($request->interests);
        }

        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile created successfully.',
            'profile' => $profile->fresh()
        ], 201);
    }

    /**
     * Display a specific profile.
     */
    public function show($id)
    {
        $profile = Profile::with('user')->findOrFail($id);
        return response()->json($profile);
    }

    /**
     * Update an existing profile.
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $validated = $request->validate([
            'bio' => 'nullable|string',
            'education' => 'nullable|string',
            'age' => 'nullable|integer',

            'relationship_goal' => 'nullable|in:friendship,dating,long_term,casual,unsure',
            'gender' => 'nullable|in:male,female,non-binary,other',

            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'location' => 'nullable',

            'height' => 'nullable|integer',
            'skin_color' => 'nullable|in:light,medium,dark,other',
            'body_type' => 'nullable|in:slim,athletic,average,curvy,muscular,plus_size_curvy,plus_size_solid,other',

            'drinking' => 'nullable|in:dont_drink,on_special_occasions,weekends,everyday',
            'smoking' => 'nullable|in:dont_smoke,smoker_when_drinking,trying_to_quit,regular_smoker',
            'exercise' => 'nullable|in:every_day,often,sometimes,never',

            'religion' => 'nullable|in:christian,muslim,hindu,buddhist,atheist,other',
            'politics' => 'nullable|in:liberal,conservative,moderate,apolitical,other',

            'style' => 'nullable|in:casual,athletic,business,bohemian,alternative,preppy,vintage,designer,other',

            'has_tattoos' => 'nullable|boolean',
            'has_piercings' => 'nullable|boolean',

            'interests' => 'nullable|array',
        ]);

        // Fill fields
        $fields = [
            'bio', 'education', 'age', 'relationship_goal', 'gender', 'country', 'state', 'city', 'location',
            'height', 'skin_color', 'body_type', 'drinking', 'smoking', 'exercise', 'religion', 'politics', 'style',
            'has_tattoos', 'has_piercings'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $profile->{$field} = $request->{$field};
            }
        }

        if ($request->has('interests')) {
            $profile->interests = json_encode($request->interests);
        }

        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'profile' => $profile->fresh()
        ]);
    }

    /**
     * Remove a profile.
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile deleted successfully.'
        ]);
    }
}
