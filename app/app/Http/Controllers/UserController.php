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

    public function edit($slug)
    {
        $response = Http::get(ApiUrl::$api_url . "/user/" . $slug);
        $user = SessionService::user();
        if ($response->failed()) {
            return view('cpanel.user.edit', ['error' => $response['message']]);
        }
        $OddUser = $response->json()['data'];

        $shopListResponse = Http::get(ApiUrl::$api_url . "/shop");
        $shopList = $shopListResponse->json();
        $oddIdShop = null;
        $shops = [];
        if (isset($shopList['data']['shops'])) {
            $shops = array_column($shopList['data']['shops'], 'shopName', 'idShop');
            $oddIdShop = array_reduce($shopList['data']['shops'], function($carry, $shop) use ($OddUser) {
                return $OddUser["shopSlug"] && $shop["slug"] == $OddUser["shopSlug"] ? $shop["idShop"] : $carry;
            }, null);
        }
        $OddUser["idShop"] = $oddIdShop;
        return view('cpanel.user.edit', [
            "profile" => $user,
            "user" => $OddUser,
            "shopList" => $shops,
        ]);
    }

    public function update(Request $request, $slug)
    {
        // 1. Validate request

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email',
            'password' => 'nullable|string',
            'idShop' => 'nullable|string',
            'role' => 'nullable|string',
            'isActive' => 'nullable|boolean',
        ]);

        $req_api = [
            'name' => $request->name,
            'email' => $request->email,
            'idShop' => $request->idShop,
            'role' => $request->role,
            'isActive' => $request->isActive,
        ];

        if ($request->input('password')) {
            $req_api['password'] = $request->input('password');
        }

        $response = Http::put(ApiUrl::$api_url . "/user/" . $slug, $req_api);
        if ($response->failed()) {
            $errors = $response->json()["error"]["description"];
            return redirect("/product/create")->withErrors($errors)->withInput();
        }
        return redirect("/dashboard");
    }

    // Add new shop to user
    public function addShop(Request $request, $slug)
    {
        $request->validate([
            'idShop' => 'required|string',
        ]);

        $response = Http::post(ApiUrl::$api_url . "/user/" . $slug . "/shop", [
            'idShop' => $request->idShop,
        ])->json();

        if ($response["success"]) {
            return redirect('/dashboard/user/' . $slug . '/edit')->with(["message" => $response["messages"] ?? ""]);
        } else {
            return redirect('/dashboard/user/' . $slug . '/edit')->with(["message" => $response["messages"] ?? ""]);
        }
    }
}
