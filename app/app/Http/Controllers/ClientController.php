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
        /*
        | Jika User yang loginnya sukses adalah Kasir maka akan diarahkan ke halaman kasir
        | Jika User adalah loginnya sukses ShopEmployee maka akan diarahkan ke halaman shop
        */
        // Contoh
        // if (SessionService::get('role') == 'Kasir') {
        //     return view('cpanel.main.dashboard');
        // }

        $user = SessionService::user();

        return view('clients.index', [
            "profile" => $user
        ]);
    }

    public function show()
    {
        return view('clients.show');
    }
}
