<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Orders\CreateRequest;
use App\Http\Requests\Orders\UpdateRequest;
use App\Http\Resources\Orders\OrderDetailResource;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Orders;
use App\Models\Tickets;
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
        DB::beginTransaction();

        try {
            $slugOrder = Helper::generateSlug("O", "orders");
            $order = Orders::create([
                "idUser" => $validated["idKasir"],
                "BuyerName" => $validated["buyerName"],
                "slug" => $slugOrder,
                "TotalOrder" => 1
            ]);
            $totalOrder = 0;
            foreach ($validated["tickets"] as $ticket) {
                $getTicket = Tickets::where('slug', $ticket["slugTicket"])->first();
                $totalOrder += $getTicket->priceTickets;
                $getTicket->update([
                    "idOrder" => $order->idOrder
                ]);
            }
            $order->update([
                "TotalOrder" => $totalOrder
            ]);

            DB::commit();
            return response()->json($order->load('tickets'), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
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
    public function update(UpdateRequest $request, Orders $order)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $order->update([
                "idKasir" => $validated["idKasir"] ?? NULL,
                "BuyerName" => $validated["buyerName"] ?? NULL,
                "TotalOrder" => 1
            ]);
            $oldTickets = Tickets::where("idOrder", $order->idOrder)->get();
            foreach ($oldTickets as $ticket) {
                $ticket->idOrder = NULL;
                $ticket->save();
            }
            $totalOrder = 0;
            foreach ($validated["tickets"] as $ticket) {
                $getTicket = Tickets::where('slug', $ticket["slugTicket"])->first();
                $totalOrder += $getTicket->priceTickets;
                $getTicket->update([
                    "idOrder" => $order->idOrder
                ]);
            }
            $order->update([
                "TotalOrder" => $totalOrder
            ]);
            DB::commit();
            return response()->json($order, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }

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
