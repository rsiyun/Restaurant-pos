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
        $token = session('user.access_token')??"";

        $product = Http::withToken($token)->get(ApiUrl::$api_url . '/products');
        return view('products.index', ['products' => $product->json()]);
    }

    public function store(Request $request)
    {
        $user = SessionService::user();
        $token = session('user.access_token')??"";
        $getShop = Http::withToken($token)->get(ApiUrl::$api_url . "/shop/" . $user["shopSlug"]);
        if ($getShop->failed()) {
            return redirect("/product/create")->withErrors(['message', 'Tambah product gagal']);
        }
        $idShop = $getShop['data']['idShop'];
        $req_api = [
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productStock' => $request->input('productStock'),
            'productType' => $request->input('productType'),
            'idShop' => $idShop
        ];
        $response = $this->postStore($request, $req_api, $token);
        if ($response->failed()) {
            $errors = $response->json()["error"]["description"];
            return redirect("/product/create")->withErrors($errors)->withInput();
        }
        return redirect("/")->with("message", "product berhasil ditambahkan");
    }
    public function edit($slug)
    {
        $token = session('user.access_token') ?? "";
        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/product" . "/$slug");
        $user = SessionService::user();
        if ($response->failed()) {
            return redirect()->back()->withErrors(["message", "tidak dizinkan masuk kehalaman ini, silahkan login ulang"]);
        }
        $productInput = $response->json();
        $response = [
            "slug" => $productInput["data"]["slug"],
            "productImage" => $productInput["data"]["productImage"],
            "productName" => $productInput["data"]["productName"],
            "productPrice" => $productInput["data"]["productPrice"],
            "productType" => $productInput["data"]["productType"],
            "productStock" => $productInput["data"]["productStock"],
        ];
        if ($response) {
            return view('clients.edit', [
                "profile" => $user,
                "product" => $response,
            ]);
        }
    }


    public function update(Request $request, $slug)
    {
        $token = session('user.access_token') ?? "";
        $req_api = [
            "productName" => $request->productName,
            "productPrice" => $request->productPrice,
            "productType" => $request->productType,
            "productStock" => $request->productStock,
            "slug" => $slug
        ];
        $response = $this->updateStore($request, $req_api, $token);
        if ($response->successful()) {
            $res = $response->json();
            return redirect('/')->with('message', $res['messages']);
        }
        return back()->withErrors(['message' => 'Gagal memperbarui produk']);
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token')??"";
        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/product" . "/" . $slug);

        if ($response->failed()) {
            return redirect()->back();
        }
        $showProduct = $response->json();
        return view('clients.show', ["profile" => $user, "product" => $showProduct["data"]]);
    }

    public function create()
    {
        $user = SessionService::user();
        return view('clients.create', ["profile" => $user]);
    }


    private function updateStore($request, $req_api, $token)
    {
        if ($request->hasFile('productImage')) {
            $response = Http::withToken($token)->withHeaders([
                'X-HTTP-Method-Override' => 'PUT',
            ])->attach(
                    'productImage',
                    file_get_contents($request->file('productImage')),
                    $request->file('productImage')->getClientOriginalName()
                )->post(ApiUrl::$api_url . "/product/" . $req_api["slug"], $req_api);
        }
        $response = Http::withToken($token)->withHeaders([
            'X-HTTP-Method-Override' => 'PUT',
        ])->post(ApiUrl::$api_url . "/product/" . $req_api["slug"], $req_api);
        return $response;
    }
    private function postStore($request, $req_api, $token)
    {
        if ($request->hasFile("productImage")) {
            $response = Http::withToken($token)->attach(
                'productImage',
                file_get_contents($request->file('productImage')),
                $request->file('productImage')->getClientOriginalName()
            )->post(ApiUrl::$api_url . "/product", $req_api);
            return $response;
        }
        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/product", $req_api);
        return $response;
    }
}
