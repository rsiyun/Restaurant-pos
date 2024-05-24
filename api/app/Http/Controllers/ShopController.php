<?php

namespace App\Http\Controllers;

use App\Http\Resources\Shops\ShopResource;
use App\Models\Shop;
use App\Helpers\Helper;
use App\Http\Requests\Shop\CreateRequest;
use App\Http\Requests\Shop\UpdateRequest;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::paginate(9);
        $response = [
            "shops" => ShopResource::collection($shops),
            'links' => [
                'first' => $shops->url(1),
                'last' => $shops->url($shops->lastPage()),
                'prev' => $shops->previousPageUrl(),
                'next' => $shops->nextPageUrl(),
            ],
        ];
        return $this->sendResponse($response, 'All Data Shops Successfully Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $slug = Helper::generateSlug("s", "shops");
        $shop = Shop::create([
            "slug" => $slug,
            "isActive" => 1,
            ...$validated
        ]);

        return $this->sendResponse(new ShopResource($shop), "Shops Berhasil DiTambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $response = Shop::with('products')->select("idShop", "ownerName", "slug", "shopName", "isActive")
            ->with(['employee:idUser,name,slug,email,role,idShop'])
            ->where('slug', $shop->slug)
            ->first();

        return $this->sendResponse(new ShopResource($response), "Shops Berhasil Di ambil;");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Shop $shop)
    {
        $validated = $request->validated();
        $slug = $shop->slug;

        if ($validated["shopName"] != $shop->shopName) {
            $slug = Helper::generateSlug("s", "shops");
        }

        $shop->update([
            "slug" => $slug,
            ...$validated
        ]);

        return $this->sendResponse(new ShopResource($shop), "Shop Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return $this->sendResponse(new ShopResource($shop), "Shop Berhasil DiHapus");
    }
}
