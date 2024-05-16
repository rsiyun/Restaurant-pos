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
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'productType' => 'required|string|max:255',
            'idShop' => 'required|integer',
            'productStock' => 'required|integer',
            'productImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('product_images', 'public');
            $validatedData['productImage'] = $imagePath;
        }

        $product = Product::create($validatedData);

        return response()->json([
            'message' => 'Product Berhasil DiTambahkan',
            'status' => true,
            'data' => $product
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
        $validatedData = $request->validate([
            'productName' => 'sometimes|required|string|max:255',
            'productPrice' => 'sometimes|required|numeric',
            'productType' => 'sometimes|required|string|max:255',
            'idShop' => 'sometimes|required|integer',
            'productStock' => 'sometimes|required|integer',
            'productImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('productImage')) {
            if ($product->productImage) {
                Product()::disk('public')->delete($product->productImage);
            }
            $imagePath = $request->file('productImage')->store('product_images', 'public');
            $validatedData['productImage'] = $imagePath;
        }

        $product->update($validatedData);

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
        if ($product->productImage) {
            Product::disk('public')->delete($product->productImage);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product Berhasil Dihapus',
            'status' => true
        ]);
    }
}
