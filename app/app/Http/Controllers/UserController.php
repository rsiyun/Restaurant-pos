<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/user")->json();
        if ($response["success"]) {
            $listUser = $response['data'];
            dump($listUser);
            return view('cpanel.user.index', compact('listUser'));
        } else {

            return view('cpanel.user.index', ['error' => $response['message']]);
        }
    }

    public function create()
    {
        return view('cpanel.user.create');
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
            // get back using url route instead of route name
            return redirect('/dashboard/dev');
        }

        return dump($response);
    }
}
