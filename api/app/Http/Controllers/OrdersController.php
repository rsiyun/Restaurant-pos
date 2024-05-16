<?php

namespace App\Http\Controllers;

use App\Http\Resources\Orders\OrderDetailResource;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with("kasir")->get();
        if ($orders->isEmpty()) {
            return $this->sendError('Users do not exist.');
        }
        return $this->sendResponse(OrderResource::collection($orders), 'All Orders Successfully Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        $response = Orders::with(['kasir', 'tickets.shop', 'tickets.details', 'tickets.details.product'])->where('slug', $orders->slug)->first();
        // return response()->json([
        //     "message" => "shop details",
        //     "status" => true,
        //     "data" => $response
        // ],200);
        return $this->sendResponse(new OrderDetailResource($response), 'shop details');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
