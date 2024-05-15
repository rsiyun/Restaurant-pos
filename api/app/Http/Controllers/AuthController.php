<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => "required"
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            "role" => $validatedData["role"],
            "isActive" => true,
            'password' => Hash::make($validatedData['password']),
        ]);
        $response = [
            "name" => $user["name"],
            "email" => $user["email"]
        ];

        return response()->json([
            "message" => "Registration Successfull",
            "status" => true,
            "data" => $response
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Bad Request',
                'status' => false,
                'error' => [
                    'code' => 400,
                    'description' => 'Please provide both email and password'
                ]
            ], 400);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstorFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'status' => true
        ]);
    }
}
