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

            return view('cpanel.shop.index', [
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

        $response = Http::withToken($token)->put(ApiUrl::$api_url . "/shop" . "/$slug", $req_api);
        // dd($response);
        if ($response->successful()) {
            return redirect('/dashboard/shop')->with(["message" => $response["messages"]]);
        }
        if($response->failed()){
            $errors = $response->json()["error"]["description"];
            return redirect()->back()->whithErrors($errors)->withInput();
        }
        return back()->withErrors(['message' => 'Failed to update shop']);
    }


    public function store(Request $request)
    {
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/shop", [
            'ownerName' => $request->ownerName,
            'shopName' => $request->shopName,
        ]);
        if ($response->successful()) {
            return redirect("/dashboard/shop");
        }
        if ($response->failed()){
            $errors = $response->json()["error"]["description"];
            return redirect()->back()->withErrors($errors)->withinput();
        }
        return redirect("/")->whith("message", "Toko berhasil ditambahkan");
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/shop" . "/$slug");
        if ($response->successful()) {
            $res = $response->json();
            return view('cpanel.shop.show', [
                "profile" => $user,
                ...$res
            ]);
        }
    }

    public function destroy($slug)
    {
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->delete(ApiUrl::$api_url . "/shop/$slug")->json();
        if ($response["success"]) {
            return redirect('/dashboard/shop')->with(["message" => $response["messages"]]);
        }
    }
}
