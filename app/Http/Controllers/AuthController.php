<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:users',
            'password' => 'required',
            'phone_number' => 'required|unique:users',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;

        

        $user->save();

        $token = $user->createToken($request->name);
        return response()->json([
            'message' => 'user registered successfully!',
            'token'   =>$token->plainTextToken,
            'user' => $user,

        ], 201);

    }
        public function login(Request $request){
            
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',




        ]);
        $user = User::where('email', $request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ], 401);

        }
        $token = $user->createToken($user->name);
        return response()->json([
            'message' => 'Login successful!',
            'user' => $user,
            'token'   =>$token->plainTextToken,
           

        ], 200);


    }
        public function logout(Request $request){
          $request->user()->tokens()->delete();

          return response()->json([
            'message' => 'You are logged out'
          ]);
        
    }
}
