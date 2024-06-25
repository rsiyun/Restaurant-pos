<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;

class DashboardController extends Controller
{

    public function index()
    {
        $token = session('user.access_token') ?? "";

        $dashboard = Http::withToken($token)->get(ApiUrl::$api_url . "/dashboard");
        $user = SessionService::user();
        $response = $dashboard->json();

        // Pass the data to the view
        return view('cpanel.main.dashboard', [
            "listUser" => $response["data"]["users"],
            "listShop" => $response["data"]["shops"],
            "listOrder" => $response["data"]["orders"],
            "listTicket" => $response["data"]["tickets"],
            "profile" => $user
        ]);
    }


    // WARNING JANGAN DI HAPUS
    public function dev()
    {
    }

    public function components()
    {
        return view('cpanel.main.components');
    }
}
