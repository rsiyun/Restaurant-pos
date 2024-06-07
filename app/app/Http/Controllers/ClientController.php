<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? "";
        $productType = $request->type ?? "";
        $search = $request->s ?? "";
        $user = SessionService::user();
        $token = session('user.access_token');

        if (!$token) {
            return redirect()->route('login');
        }

        $productAPI = Http::withToken($token)->get(ApiUrl::$api_url . "/productByShop" . "/" . $user["shopSlug"], ["page" => $page, "s" => $search, "type" => $productType])->json();
        return view('clients.index', [
            "profile" => $user,
            "products" => $productAPI["data"]["products"],
            "links" => $productAPI["data"]["links"]
        ]);
    }

    public function edit($slug)
    {
        $productInput = Http::get(ApiUrl::$api_url . "/product" . "/$slug");
        $user = SessionService::user();
        $success = $productInput["success"];
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
                "success" => $success,
            ]);
        }
    }


    public function update(Request $request, $slug)
    {
        // dd($user);
        $req_api = [
            "productName" => $request->productName,
            "productPrice" => $request->productPrice,
            "productType" => $request->productType,
            "productStock" => $request->productStock,
        ];
        if ($request->hasFile('productImage')) {
            $response = Http::withHeaders([
                'X-HTTP-Method-Override' => 'PUT',
            ])->attach(
                    'productImage',
                    file_get_contents($request->file('productImage')),
                    $request->file('productImage')->getClientOriginalName()
                )->post(ApiUrl::$api_url . "/product/" . $slug, $req_api);
        } else {
            $response = Http::withHeaders([
                'X-HTTP-Method-Override' => 'PUT',
            ])->post(ApiUrl::$api_url . "/product/" . $slug, $req_api);
        }

        // dd($req_api);

        // dd($response->json());

        if ($response->successful()) {
            $res = $response->json();
            // dd($res);
            return redirect('/')->with('message', $res['messages']);
        } else {
            return back()->withErrors(['message' => 'Gagal memperbarui produk']);
        }
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

    public function create()
    {
        $user = SessionService::user();
        // dump($user);
        return view('clients.create', ["profile" => $user]);
    }

    public function destroy($slug)
    {
        $response = Http::delete(ApiUrl::$api_url . "/product" . "/" . $slug)->json();
        if ($response["success"]) {
            return redirect('/')->with(["message" => $response["messages"]]);
        }
    }
}
