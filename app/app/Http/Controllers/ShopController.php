<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
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

}
