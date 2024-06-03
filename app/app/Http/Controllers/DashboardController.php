<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/user");
        $user = SessionService::user();
        if ($response->successful()) {
            $listUser = $response->json()['data'];
            return view('cpanel.main.dashboard', [
                "listUser" => $listUser,
                "profile" => $user
            ]);
        }
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
