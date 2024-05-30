<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request){
        $cart = $request->session()->get('cart', []);
        $user = SessionService::user();
        if ($user["shopSlug"] == null) {
            return redirect('/')->with("message", "anda belum bergabung dengan toko");
        }
        $shop = Http::get(ApiUrl::$api_url . "/shop" . "/" . $user["shopSlug"])->json();
        if (!$shop || !$shop["success"]) {
            return redirect('/')->with("message", "shop gagal diambil");
        }
        $ticketCart = [];
        dd($cart);
        die;
    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }

}
