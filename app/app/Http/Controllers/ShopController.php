<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Services\SessionService;

class ShopController extends Controller
{
    public function index()
    {
        $token = session('user.access_token') ?? "";
        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/shop");
        $user = SessionService::user();
        if ($response->successful()) {
            $shops = $response['data'];

            return view('cpanel.main.shop', [
                "profile" => $user,
                "shops" => $shops
            ]);
        }
        return redirect('/dashboard');
    }

    public function create()
    {
        $user = SessionService::user();
        return view('cpanel.shop.create', ["profile" => $user]);
    }

    public function edit($slug)
    {
        $token = session('user.access_token') ?? "";

        $shopInput = Http::withToken($token)->get(ApiUrl::$api_url . "/shop" . "/$slug")->json();
        $user = SessionService::user();
        $success = $shopInput["success"];
        $response = [
            "ownerName" => $shopInput["data"]["ownerName"],
            "slug" => $shopInput["data"]["slug"],
            "shopName" => $shopInput["data"]["shopName"],
            "isActive" => $shopInput["data"]["isActive"],
            "success" => $success,
        ];
        if ($response["success"]) {
            return view('cpanel.shop.edit', [
                "profile" => $user,
                ...$response
            ]);
        }
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            "ownerName" => "required|string",
            "shopName" => "required|string",
            "isActive" => "required|",
        ]);
        $user = SessionService::user();
        $req_api = [
            "idKasir" => $user["idUser"],
            "ownerName" => $request->ownerName,
            "shopName" => $request->shopName,
            "isActive" => $request->isActive,
        ];
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->put(ApiUrl::$api_url . "/shop" . "/$slug", $req_api)->json();
        // dd($response);
        if ($response["success"]) {
            return redirect('/dashboard/shop')->with(["message" => $response["messages"]]);
        } else {
            // handle the failure case
            return back()->withErrors(['message' => 'Failed to update shop']);
        }
    }


    public function store(Request $request)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/shop", [
            'ownerName' => $request->ownerName,
            'shopName' => $request->shopName,
        ])->json();
        if ($response["success"]) {
            return redirect("/dashboard/shop");
        }
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/shop" . "/$slug")->json();
        $user = SessionService::user();
        if ($response["success"]) {
            return view('cpanel.shop.show', [
                "profile" => $user,
                ...$response
            ]);
        }
    }

    public function destroy($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->delete(ApiUrl::$api_url . "/shop/$slug")->json();
        if ($response["success"]) {
            return redirect('/dashboard/shop')->with(["message" => $response["messages"]]);
        }
    }
}
