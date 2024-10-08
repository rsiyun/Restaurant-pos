<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with("shop")->get();
        return $this->sendResponse(ProductResource::collection($products), "All Products");
    }

    public function showByShop(Request $request, $slug){
        $request->validate([
            "s" => "nullable|string",
            "type" => "nullable|string"
        ]);
        $search = $request->input('s');
        $type = $request->input('type');

        $query = Product::with("shop")->whereHas('shop', function($query) use ($slug) {$query->where('slug', $slug);});
        if ($search) {
            $query->where('productName', 'like', '%' . $search . '%');
        }
        if ($type) {
            $query->where('productType', $type);
        }
        $products = $query->paginate(8);
        $response = [
            "products" => ProductResource::collection($products),
            'links' => [
                'first' => Helper::getParams($products->url(1))["page"] ?? null,
                'last' => Helper::getParams($products->url($products->lastPage()))["page"] ?? null,
                'prev' => Helper::getParams($products->previousPageUrl())["page"] ?? null,
                'next' => Helper::getParams($products->nextPageUrl())["page"] ?? null,
            ],
        ];
        return $this->sendResponse($response, "All Products");

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $slug = Helper::generateSlug("p", "products");
        $validated["productImage"] = "product_images/gofood.jpeg";
        if ($request->hasFile("productImage")) {
            $validated["productImage"] = $request->file('productImage')->store('product_images');
        }
        $product = Product::create([
            "slug" => $slug,
            ...$validated
        ]);
        return $this->sendResponse(new ProductResource($product), "Product Berhasil DiTambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $response = Product::with(['shop'])->where('slug', $product->slug)->first();
        return $this->sendResponse(new ProductResource($response), "Get a Product");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $validated = $request->validated();
        $slug = $product->slug;
        if ($validated["productName"] != $product->productName) {
            $slug = Helper::generateSlug("p", "products");
        }
        if ($request->hasFile('productImage')) {
            if ($product->productImage) {
                Storage::delete($product->productImage);
            }
            $imagePath = $request->file('productImage')->store('product_images');
            $validated['productImage'] = $imagePath;
        }

        $product->update([
            "slug" => $slug,
            ...$validated
        ]);
        return $this->sendResponse(new ProductResource($product), "Product Berhasil Diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->productImage) {
            Storage::delete($product->productImage);
        }
        $product->delete();
        return $this->sendResponse(new ProductResource($product), "Product Berhasil DiHapus");
    }
}
