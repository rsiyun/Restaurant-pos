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
            $users = $response['data'];

            return view('cpanel.user.index', compact('users'));
        } else {

            return view('cpanel.user.index', ['error' => $response['message']]);
        }
    }
}
