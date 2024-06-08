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
        // $response = Http::get(ApiUrl::$api_url . "/user")->json();
        // $data = $response['data'];
        // get only 5 user
        // $response['data'] = array_slice($response['data'], 0, 5);

        // another way to get user limited to 5 and by using query parameter
        // $getUserBy = array_values(
        //     array_filter(
        //         $data,
        //         function ($user, $index) {
        //             return $index < 5;
        //         },
        //         ARRAY_FILTER_USE_BOTH
        //     )
        // );

        // $user = SessionService::user();
        // if ($response["success"]) {
        //     $listUser = $getUserBy;
        //     return view('cpanel.user.index', [
        //         "profile" => $user,
        //         "listUser" => $listUser
        //     ]);
        // return view('cpanel.user.index', ['error' => $response['message']]);
        // }
        $page = $request->page ?? "";
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $userResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/user", ["page" => $page]);

        if ($userResponse->failed()) {
            return redirect("/")->withErrors(['message' => "gagal mendapatkan user"]);
        }

        $response = $userResponse->json()["data"];
        // dd($response);
        return view("cpanel.user.index", ["listUser" => $response, "profile" => $user]);


    }

    public function create()
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        return view('cpanel.user.create', ["profile" => $user]);
    }

    public function store(Request $request)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/user", [
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
        $user = SessionService::user();
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
        if (isset($shopList['data']['shops'])) {
            $shops = array_column($shopList['data']['shops'], 'shopName', 'idShop');
            $oddIdShop = array_reduce($shopList['data']['shops'], function ($carry, $shop) use ($OddUser) {
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

        $response = Http::withToken($token)->put(ApiUrl::$api_url . "/user/" . $slug, $req_api);
        if ($response->failed()) {
            $errors = $response->json()["error"]["description"];
            return redirect("/product/create")->withErrors($errors)->withInput();
        }
        return redirect("/dashboard");
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
