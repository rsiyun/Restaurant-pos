<?php

namespace App\Http\Controllers;

use App\Http\Resources\Shops\ShopResource;
use App\Models\Shop;
use Illuminate\Http\Request;
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
        $shops = Shop::all();

        if ($shops->isEmpty()) {
            return $this->sendError('Shops do not exist.');
        }

        return $this->sendResponse(ShopResource::collection($shops), 'All Data Shops Successfully Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $slug = Helper::generateSlug($validated["ownerName"], "shops");
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

        if ($validated["ownerName"] != $shop->ownerName) {
            $slug = Helper::generateSlug($validated["ownerName"], "shops");
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
