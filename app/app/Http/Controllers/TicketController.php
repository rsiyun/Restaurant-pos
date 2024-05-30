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
        $totalPrice = 0;

        foreach ($cart as $item) {
            $productResponse = Http::get(ApiUrl::$api_url . "/product/" . $item["slug"]);
            if ($productResponse->successful()) {
                $product = $productResponse->json()["data"];
                $totalPrice += $product["productPrice"] * $item["quantity"];

                $ticketCart[] = [
                    "slugProduct" => $item["slug"],
                    "quantity" => $item["quantity"],
                    "priceTicketDetail" => $product["productPrice"] * $item["quantity"]
                ];
            } else {
                return redirect('/')->with("message", "Gagal mengambil data produk: " . $item["slug"]);
            }
        }

        $ticketResponse = Http::post(ApiUrl::$api_url . "/ticket", [
            "idShop" => $shop["idShop"],
            "orderNote" => $orderNote,
            "ticketCart" => $ticketCart,
            "priceTickets" => $totalPrice
        ]);
        // dd($ticketResponse->json());
        // die;
        if ($ticketResponse->failed()) {
            return redirect('/')->with("message", "Gagal membuat tiket: " . $ticketResponse->body());
        }

        if ($ticketResponse->successful()) {
            $request->session()->forget('cart');
            return redirect('/')->with("message", "Tiket berhasil dibuat");
        } else {
            return redirect('/')->with("message", "Gagal membuat tiket");
        }
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
