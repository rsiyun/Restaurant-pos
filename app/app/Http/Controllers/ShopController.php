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
        $response = Http::get(ApiUrl::$api_url . "/shop")->json();
        $user = SessionService::user();
        if ($response["success"]) {
            $shops = $response['data'];

            return view('cpanel.main.shop', [
                "profile" => $user,
                "shops" => $shops
            ]);
        }
        return view('cpanel.main.shop', ['error' => $response['message']]);
    }

    public function create()
    {
        $user = SessionService::user();
        return view('cpanel.shop.create', ["profile" => $user]);
    }

    public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url . "/shop", [
            'ownerName' => $request->ownerName,
            'shopName' => $request->shopName,
            ])->json();
        if ($response["success"]) {
            return redirect("/dashboard/shop");
        }

    }

    public function show($slug)
    {

        $response = Http::get(ApiUrl::$api_url . "/shop" . "/$slug")->json();
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
        $response = Http::delete(ApiUrl::$api_url . "/shop/$slug")->json();
        if ($response["success"]) {
            return redirect('/dashboard/shop')->with(["message" => $response["messages"]]);
        }
    }

}
