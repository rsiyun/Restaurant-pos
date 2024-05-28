<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

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
        $slug = Helper::generateSlug("u", "users");
        $user = User::create([
            'name' => $validatedData['name'],
            'slug' => $slug,
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
            "success" => true,
            "data" => $response
        ]);
    }

    public function showWithToken(Request $request){
        $hashedToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedToken);
        if (!$token) {
            throw new HttpResponseException(response([
                "message" => "Unauthorized",
                "success" => false,
                "error" => [
                    "code" => 401,
                    "description" => "invalid token"
                ]
            ],401));
        }
        $userToken = $token->tokenable;
        $user = User::with("shop")->where("slug", $userToken["slug"])->first();
        return response()->json([
            "message" => "user get successfully",
            "success" => true,
            "data" => [
                "idUser" => $user["idUser"],
                "shopSlug" => $user["shop"]["slug"] ?? null,
                "name" => $user["name"],
                "email" => $user["email"],
                "role" => $user["role"],
                "slug" => $user["slug"]
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response([
                "message" => "Unprocessable Content",
                "success" => false,
                "error" => [
                    "code" => 422,
                    "description" => $validator->getMessageBag()
                ]
            ],422));
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new HttpResponseException(response([
                "message" => "Unauthorized",
                "success" => false,
                "error" => [
                    "code" => 401,
                    "description" => "Invalid credential"
                ]
            ],401));
        }

        $user = User::select("idUser","slug", "name", "email")->where('email', $request['email'])->where("isActive", 1)->first();
        if (!$user) {
            throw new HttpResponseException(response([
                "message" => "Unauthorized",
                "success" => false,
                "error" => [
                    "code" => 401,
                    "description" => "You have been banned by admin"
                ]
            ],401));
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "message" => "login successfully",
            'success' => true,
            "data" => [
                'access_token' => $token,
                "slug" => $user->slug,
                "name" => $user->name,
                "email" => $user->email
            ]
        ]);
    }

    public function logout(Request $request){
        $hashedToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedToken);
        $token->delete();
        return response()->json([
            "message" => "logged out successfully",
            "success" => true
        ], 200);
    }
}
