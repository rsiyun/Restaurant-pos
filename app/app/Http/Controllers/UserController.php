<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Facades\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/user")->json();
        $user = SessionService::user();
        if ($response["success"]) {
            $listUser = $response['data'];

            return view('cpanel.user.index', [
                "profile" => $user,
                "listUser" => $listUser
            ]);
        }
        return view('cpanel.user.index', ['error' => $response['message']]);
    }

    public function create()
    {
        $user = SessionService::user();
        return view('cpanel.user.create', ["profile" => $user]);
    }

    public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url . "/user", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ])->json();
        if ($response["success"]) {
            return redirect("/dashboard/user");
        }

    }

    public function edit($id)
    {
        $response = Http::get(ApiUrl::$api_url . "/user/" . $id)->json();
        $user = SessionService::user();
        if ($response["success"]) {
            $user = $response['data'];
            return view('cpanel.user.edit', [
                "profile" => $user,
                "user" => $user
            ]);
        }
        return view('cpanel.user.edit', ['error' => $response['message']]);
    }
}
