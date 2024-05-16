<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idProduct' => 'required|numeric',
            'idShop' => 'required|interger',
            'quantity' => 'required|integer',
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'productType' => 'required|string|max:255',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json([
            'message' => 'Product Berhasil Diupdate',
            'status' => true,
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product Berhasil Dihapus',
            'status' => true
        ]);
    }
}
