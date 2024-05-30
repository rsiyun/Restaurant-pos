<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function index()
    {
        $user = SessionService::user();
        $productAPI = Http::get(ApiUrl::$api_url . "/productByShop" . "/" . $user["shopSlug"])->json();
        return view('clients.index', [
            "profile" => $user,
            "products" => $productAPI["data"]["products"]
        ]);
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $showProduct = Http::get(ApiUrl::$api_url . "/product" . "/" . $slug)->json();
        if (!$showProduct || !$showProduct["success"]) {
            return redirect()->back();
        }
        return view('clients.show', ["profile" => $user, "product" => $showProduct["data"]]);
    }

    public function addToCart(Request $request, $slug)
    {
        $productResponse = Http::get(ApiUrl::$api_url . "/product/" . $slug);

        if ($productResponse->failed()) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $product = $productResponse->json();
        $productData = $product['data'] ?? null;

        if (!$productData) {
            return response()->json(['error' => 'Invalid product data.'], 400);
        }

        $cart = $request->session()->get('cart', []);

        $quantity = (int) $request->input('quantity', 1);

        if ($quantity > $productData['productStock']) {
            return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] += $quantity;
            $cart[$slug]['total'] = $cart[$slug]['quantity'] * ($cart[$slug]['productPrice'] ?? 0);
        } else {
            $cart[$slug] = [
                'slug' => $productData['slug'] ?? $slug,
                'productName' => $productData['productName'] ?? 'Product Name Unavailable',
                'productPrice' => $productData['productPrice'] ?? 0,
                'productImage' => $productData['productImage'] ?? '',
                'productStock' => $productData['productStock'] ?? 0,
                'productType' => $productData['productType'] ?? '',
                'quantity' => $quantity,
                'total' => $quantity * ($productData['productPrice'] ?? 0),
            ];
        }

        $productData['productStock'] -= $quantity;

        $request->session()->put('cart', $cart);

        return redirect()->route('clients.showCart');
    }

    public function removeFromCart(Request $request, $slug)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('clients.showCart')->with('success', 'Produk telah dihapus dari keranjang.');
    }

    public function clearSession(Request $request)
    {
        // $request->session()->flush();
        $request->session()->forget('cart');
        return redirect()->route('clients.showCart')->with('success', 'Semua sesi telah dihapus.');
    }

    public function showCart(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        $user = SessionService::user();
        // dd($cartItems);
        return view('clients.cart', [
            "cartItems" => $cartItems,
            "profile" => $user
        ]);
    }
    public function updateCart(Request $request){
        $quantities = $request->input('quantities', []);
        $cart = $request->session()->get('cart', []);
        foreach ($quantities as $slug => $qnty) {
            $quantity = (int) $qnty;
            $cart[$slug]['quantity'] = $quantity;
            $cart[$slug]['total'] = $cart[$slug]['quantity'] * ($cart[$slug]['productPrice'] ?? 0);
        }
        $request->session()->put('cart', $cart);
        return redirect()->route('clients.showCart');
    }

}
