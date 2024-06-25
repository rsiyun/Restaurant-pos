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
        $token = session('user.access_token') ?? "";

        $page = $request->page ?? "";
        $user = SessionService::user();
        $shopResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/ticketByShop/" . $user["shopSlug"], ["page" => $page]);
        if ($shopResponse->failed()) {
            return redirect("/")->rs(['message' => "gagal mendapatkan ticket"]);
        }
        $response = $shopResponse->json()["data"];
        return view("clients.ticket.index", ["data" => $response, "profile" => $user]);
    }
    public function store(Request $request)
    {
        $token = session('user.access_token') ?? "";

        $cart = $request->session()->get('cart', []);
        $user = SessionService::user();

        if ($user["shopSlug"] == null) {
            return redirect('/')->with("message", "Anda belum bergabung dengan toko");
        }

        $shopResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/shop/" . $user["shopSlug"]);
        if ($shopResponse->failed() || !$shopResponse->json()["success"]) {
            return redirect('/')->with("message", "Gagal mengambil data toko");
        }

        $shop = $shopResponse->json()["data"];

        $ticketCart = [];
        $orderNote = $request->input('order_note', '');

        foreach ($cart as $item) {
            $quantity = $item['quantity'];
            $productResponse = Http::withToken($token)->get(ApiUrl::$api_url . "/product/" . $item['slug']);

            $productData = $productResponse->json()["data"];
            $productStock = $productData["productStock"];

            if ($quantity > $productStock) {
                return redirect()->back()->withErrors(["message" => "Gagal Membuat Checkout, Stock Melebihi batas"])->withInput();
            }

            $ticketCart[] = [
                "slugProduct" => $item["slug"],
                "quantity" => $quantity
            ];
        }

        $ticketResponse = Http::withToken($token)->post(ApiUrl::$api_url . "/ticket", [
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
