<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $response = Http::get(ApiUrl::$api_url . "/user");
    //     $user = SessionService::user();
    //     if ($response->successful()) {
    //         $listUser = $response->json();
    //         return view('cpanel.main.dashboard', [
    //             "listUser" => $listUser["data"],
    //             "profile" => $user
    //         ]);
    //     }
    // }

    public function index()
{
    // Retrieve user data
    $userResponse = Http::get(ApiUrl::$api_url . "/user");
    $user = SessionService::user();

    // Initialize data arrays
    $listUser = [];
    $listShop = [];
    $listOrder = [];

    // Check if the user response is successful
    if ($userResponse->successful()) {
        $listUser = $userResponse->json();
    }

    // Retrieve shop data
    $shopResponse = Http::get(ApiUrl::$api_url . "/shop");
    if ($shopResponse->successful()) {
        $listShop = $shopResponse->json();
    }

    // Retrieve order data
    $orderResponse = Http::get(ApiUrl::$api_url . "/order");
    if ($orderResponse->successful()) {
        $listOrder = $orderResponse->json();
    }

    $orderResponse = Http::get(ApiUrl::$api_url . "/ticket");
    if ($orderResponse->successful()) {
        $listOrder = $orderResponse->json();
    }

    // Pass the data to the view
    return view('cpanel.main.dashboard', [
        "listUser" => $listUser["data"] ?? [],
        "listShop" => $listShop["data"] ?? [],
        "listOrder" => $listOrder["data"] ?? [],
        "listTicket" => $listOrder["data"] ?? [],
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
