<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    function index()
    {
        $productAPI = Http::get('http://localhost:8001/api/products');

        return view('products.index', ['products' => $productAPI->json()]);
    }

    // public function store(Request $request)
    // {
    //     // Expected ID shop, tapi dapetnya null bang, ga ada di session
    //     $idShop = SessionService::user()['idShop'] ?? null;

    //     $getShop = Http::get(ApiUrl::$api_url . "/shop/" . SessionService::user()['shopSlug'])->json();

    //     // get only the idShop
    //     $idShop = $getShop['data']['idShop'];

    //     // This become string, not an array
    //     $optimized = Http::get(ApiUrl::$api_url . "/shop/" . SessionService::user()['shopSlug']['data']['idShop']);

    //     // Print that $optimized
    //     // dd($optimized->json());

    //     $response = Http::post(ApiUrl::$api_url . "/product", [
    //         'productName' => $request->input('productName'),
    //         'productPrice' => $request->input('productPrice'),
    //         'productStock' => $request->input('productStock'),
    //         'productType' => $request->input('productType'),
    //         'idShop' => $idShop,
    //     ])->json();

    //     // dump($response, $idShop, $profile, $getShop, $idShop);
    //     dump($response, $optimized->json());
    // }

    // versi 2
    public function store(Request $request)
    {
        // Retrieve the shop slug from the session
        $shopSlug = SessionService::user()['shopSlug'];

        // Get shop details using the shop slug
        $shopResponse = Http::get(ApiUrl::$api_url . "/shop/" . $shopSlug);
        $shopData = $shopResponse->json();

        // Extract the shop ID from the shop details
        $idShop = $shopData['data']['idShop'];

        // Fetch optimized shop data
        $optimizedResponse = Http::get(ApiUrl::$api_url . "/shop/" . $shopSlug);
        $optimizedData = $optimizedResponse->json();

        // Send product data to the API
        $response = Http::post(ApiUrl::$api_url . "/product", [
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productStock' => $request->input('productStock'),
            'productType' => $request->input('productType'),
            'idShop' => $idShop,
        ]);

        // Dump the response for debugging
        // dump($response->json(), $optimizedData);
        // redirect to the product index page
        return redirect("/");
    }
}
