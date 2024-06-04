<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? "";
        $productType = $request->type ?? "";
        $search = $request->s ?? "";
        $user = SessionService::user();
        $productAPI = Http::get(ApiUrl::$api_url . "/productByShop" . "/" . $user["shopSlug"], ["page" => $page, "s" => $search, "type" => $productType])->json();
        return view('clients.index', [
            "profile" => $user,
            "products" => $productAPI["data"]["products"],
            "links" => $productAPI["data"]["links"]
        ]);
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $showProduct = Http::get(ApiUrl::$api_url . "/product" . "/" . $slug)->json();
        if (!$showProduct || !$showProduct["success"]) {
            return redirect()->back();
        }
        return view('clients.show', ["profile" => $user, "product" => $showProduct["data"]]);
    }

    public function create()
    {
        $user = SessionService::user();
        // dump($user);
        return view('clients.create', ["profile" => $user]);
    }

    public function destroy($slug)
    {
        $response = Http::delete(ApiUrl::$api_url . "/product" . "/" . $slug)->json();
        if ($response["success"]) {
            return redirect('/')->with(["message" => $response["messages"]]);
        }
    }
}
