<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateRequest;
use App\Http\Resources\Orders\OrderDetailResource;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with("kasir")->get();
        return $this->sendResponse(OrderResource::collection($orders), 'All Orders Successfully Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        $response = Orders::with(['kasir', 'tickets.shop', 'tickets.details', 'tickets.details.product'])->where('slug', $orders->slug)->first();
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
        $orders->delete();
        return $this->sendResponse(new OrderResource($orders), "Order Successfully Deleted");
    }
}
