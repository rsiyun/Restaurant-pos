<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Facades\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? "";
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";


        $userResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/user", ["page" => $page]);

        if ($userResponse->failed()) {
            return redirect("/dashboard")->withErrors(['message' => "gagal mendapatkan user"]);
        }

        $response = $userResponse->json()["data"];
        return view("cpanel.user.index", ["listUser" => $response, "profile" => $user]);
    }

    public function create()
    {
        $user = SessionService::user();

        return view('cpanel.user.create', ["profile" => $user]);
    }

    public function store(Request $request)
    {
        $token = session('user.access_token') ?? "";
        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/user", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'isActive' => $request->isActive,
        ]);
        if ($response->failed()) {
        $errors = 'Coba email lain';
        $responseJson = $response->json();
        if ($responseJson && isset($responseJson["error"]["description"])) {
            $description = $responseJson["error"]["description"];
            if (stripos($description, 'email already registered') !== false) {
                $errors = 'The email has already been registered.';
            } else {
                $errors = $description;
            }
        }
        return redirect()->back()->withErrors(['email' => $errors])->withInput();
    }
    return redirect("/dashboard/user")->with('success', 'Registration successful!');
}

    public function edit($slug)
    {
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/user/" . $slug);
        $user = SessionService::user();
        if ($response->failed()) {
            return view('cpanel.user.edit', ['error' => $response['message']]);
        }
        $OddUser = $response->json()['data'];

        $shopListResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/shop");
        $shopList = $shopListResponse->json();
        $oddIdShop = null;
        $shops = [];
        if (isset($shopList['data'])) {
            $shops = array_column($shopList['data'], 'shopName', 'idShop');
            $oddIdShop = array_reduce($shopList['data'], function ($carry, $shop) use ($OddUser) {
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
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $req_api = array_filter([
            'idShop' => $request->idShop,
            'role' => $request->role,
            'isActive' => $request->isActive,
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
        ], function ($value) {
            return !is_null($value);
        });

        if (isset($req_api['name']) && is_numeric($req_api['name'])) {
            $req_api['name'] = (int) $req_api['name'];
        }

        if ($request->input('password')) {
            $req_api['password'] = $request->input('password');
        }

        $response = Http::withToken($token)->put(ApiUrl::$api_url . "/user/" . $slug, $req_api);

        if ($response->failed()) {
            $errors = 'Coba email lain';
            $responseJson = $response->json();
            if ($responseJson && isset($responseJson["error"]["description"])) {
                $description = $responseJson["error"]["description"];
                if (stripos($description, 'email already registered') !== false) {
                    $errors = 'The email has already been registered.';
                } else {
                    $errors = $description;
                }
            }
            return redirect()->back()->withErrors(['email' => $errors])->withInput();
        }
        
        return redirect("/dashboard/user")->with('success', 'Registration successful!');
    }        

    public function show($slug)
    {
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/user/" . $slug);
        if ($response->failed()) {
            return view('cpanel.user.index', ['error' => $response['message']]);
        }
        $res = $response->json();

        $shopList = null;
        if (!empty($res["data"]["shopSlug"])) {
            $shopResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/shop/" . $res["data"]["shopSlug"]);
            if (!$shopResponse->failed()) {
                $shopList = $shopResponse->json()["data"];
            }
        }
        // dd($shopList);
        $user = SessionService::user();
        return view('cpanel.user.show', [
            "profile" => $user,
            "user" => $res["data"],
            "shopList" => $shopList
        ]);
    }

    // Add new shop to user
    public function addShop(Request $request, $slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $request->validate([
            'idShop' => 'required|string',
        ]);

        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/user/" . $slug . "/shop", [
            'idShop' => $request->idShop,
        ])->json();

        if ($response["success"]) {
            return redirect('/dashboard/user/' . $slug . '/edit')->with(["message" => $response["messages"] ?? ""]);
        } else {
            return redirect('/dashboard/user/' . $slug . '/edit')->with(["message" => $response["messages"] ?? ""]);
        }
    }
}
