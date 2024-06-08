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
        $token = session('user.access_token');

        if (!$token) {
            SessionService::logout();
            return redirect()->route('login')->withErrors(["message", "tolong login terlebih dahulu"]);
        }

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/productByShop" . "/" . $user["shopSlug"], ["page" => $page, "s" => $search, "type" => $productType]);
        if ($response->failed()) {
            return view('clients.index', [
                "profile" => $user,
                "products" => [],
                "links" => [],
            ]);
        }
        $productAPI = $response->json();
        return view('clients.index', [
            "profile" => $user,
            "products" => $productAPI["data"]["products"],
            "links" => $productAPI["data"]["links"]
        ]);
    }

    public function destroy($slug)
    {
        $token = session('user.access_token');

        $response = Http::withToken($token)->delete(ApiUrl::$api_url . "/product" . "/" . $slug)->json();
        if ($response["success"]) {
            return redirect('/')->with(["message" => $response["messages"]]);
        }
    }
}
