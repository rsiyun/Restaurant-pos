<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? "";
        $user = SessionService::user();
        $shopResponse = Http::get(ApiUrl::$api_url . "/ticketByShop/" . $user["shopSlug"], ["page" => $page]);
        if ($shopResponse->failed()) {
            return redirect("/")->withErrors(['message' => "gagal mendapatkan ticket"]);
        }
        $response = $shopResponse->json()["data"];

        return view("clients.ticket.index", ["data" => $response]);
    }
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $user = SessionService::user();

        if ($user["shopSlug"] == null) {
            return redirect('/')->with("message", "Anda belum bergabung dengan toko");
        }

        $shopResponse = Http::get(ApiUrl::$api_url . "/shop/" . $user["shopSlug"]);
        if ($shopResponse->failed() || !$shopResponse->json()["success"]) {
            return redirect('/')->with("message", "Gagal mengambil data toko");
        }

        $shop = $shopResponse->json()["data"];

        $ticketCart = [];
        $orderNote = $request->input('order_note', '');

        foreach ($cart as $item) {
            $ticketCart[] = [
                "slugProduct" => $item["slug"],
                "quantity" => $item["quantity"]
            ];
        }

        $ticketResponse = Http::post(ApiUrl::$api_url . "/ticket", [
            "idShop" => $shop["idShop"],
            "orderNote" => $orderNote,
            "ticketCart" => $ticketCart
        ]);

        if ($ticketResponse->failed()) {
            return redirect('/')->with("message", "Gagal membuat tiket: " . $ticketResponse->body());
        }

        $request->session()->forget('cart');
        return redirect('/')->with("message", "Tiket berhasil dibuat");
    }

    public function edit()
    {

    }
    public function update()
    {

    }
    public function destroy()
    {

    }

}
