<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/user")->json();
        if ($response["success"]) {
            $listUser = $response['data'];
            // dd($listUser);
            return view('cpanel.main.dashboard', compact('listUser'));
        }

        return view('cpanel.main.dashboard', ['error' => $response['message']]);
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
