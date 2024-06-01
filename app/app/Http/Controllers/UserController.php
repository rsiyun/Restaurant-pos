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
        // dd($response);
        $user = SessionService::user();
        if ($response->failed()) {
            return view('cpanel.user.edit', ['error' => $response['message']]);
        }
        $OddUser = $response->json()['data'];
        // dd($OddUser);

        $shopListResponse = Http::get(ApiUrl::$api_url . "/shop");
        $shopList = $shopListResponse->json();
        // dd($shopList['data']['shops']);

        $shops = [];
        if (isset($shopList['data']['shops'])) {
            foreach ($shopList['data']['shops'] as $shop) {
                $shops[$shop['idShop']] = $shop['shopName'];
            }
        }

        return view('cpanel.user.edit', [
            "profile" => $user,
            "user" => $OddUser,
            "shopList" => $shops,
        ]);
    }

    public function update(Request $request, $slug)
    {
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
            'password' => $request->password,
            'idShop' => $request->idShop,
            'role' => $request->role,
            'isActive' => $request->isActive,
        ];
        $response = Http::put(ApiUrl::$api_url . "/user/" . $slug, $req_api)->json();

        // dd($response);
        if ($response["success"]) {
            return redirect('/dashboard/user')->with(["message" => $response["messages"] ?? ""]);
        } else {
            return redirect('/dashboard/user')->with(["message" => $response["messages"] ?? ""]);
        }
    }
}
