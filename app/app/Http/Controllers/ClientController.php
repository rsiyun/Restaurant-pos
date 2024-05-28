<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function index()
    {
        $user = SessionService::user();
        $productAPI = Http::get(ApiUrl::$api_url . "/productByShop" . "/".$user["shopSlug"])->json();
        return view('clients.index', [
            "profile" => $user,
            "products" => $productAPI["data"]["products"]
        ]);
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $showProduct = Http::get(ApiUrl::$api_url . "/product" . "/".$slug)->json();
        if (!$showProduct || !$showProduct["success"]) {return redirect()->back();}
        return view('clients.show', ["profile" => $user, "product" => $showProduct["data"]]);
    }
}
