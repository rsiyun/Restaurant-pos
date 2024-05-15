<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with("kasir:idUser,name")->get();
        return response()->json([
            "message" => "All Orders Successfully Retrived",
            "status" => true,
            "data" => $orders
        ],200);
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
        $response = Orders::with(['kasir:idUser,name,email,role', 'tickets:idTicket,idOrder,idShop,BuyerName,priceTickets'])->where('slug', $orders->slug)->first();
        return response()->json([
            "message" => "shop details",
            "status" => true,
            "data" => $response
        ],200);
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
