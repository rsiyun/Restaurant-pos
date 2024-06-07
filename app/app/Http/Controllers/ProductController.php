<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $user = SessionService::user();
        $token = session('user.access_token');

        if (!$token) {
            return redirect()->route('login');
        }

        $product = Http::withToken($token)->get(ApiUrl::$api_url . '/products');
        return view('products.index', ['products' => $product->json()]);
    }

    public function store(Request $request)
    {
        $user = SessionService::user();
        $getShop = Http::get(ApiUrl::$api_url . "/shop/" . $user["shopSlug"]);
        if ($getShop->failed()) {
            return redirect("/product/create")->withErrors(['error', 'Tambah product gagal']);
        }
        $idShop = $getShop['data']['idShop'];
        $req_api = [
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productStock' => $request->input('productStock'),
            'productType' => $request->input('productType'),
            'idShop' => $idShop
        ];
        $response = $this->postStore($request, $req_api);
        if ($response->failed()) {
            $errors = $response->json()["error"]["description"];
            return redirect("/product/create")->withErrors($errors)->withInput();
        }
        return redirect("/")->with("message", "product berhasil ditambahkan");
    }

    private function postStore($request, $req_api)
    {
        if ($request->hasFile("productImage")) {
            $response = Http::attach(
                'productImage',
                file_get_contents($request->file('productImage')),
                $request->file('productImage')->getClientOriginalName()
            )->post(ApiUrl::$api_url . "/product", $req_api);
            return $response;
        }
        $response = Http::post(ApiUrl::$api_url . "/product", $req_api);
        return $response;
    }
}
