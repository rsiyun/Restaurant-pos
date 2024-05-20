<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Orders\CreateRequest;
use App\Http\Requests\Orders\UpdateRequest;
use App\Http\Resources\Orders\OrderDetailResource;
use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Orders\ShowOrdersResource;
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
                "BuyerName" => $validated["BuyerName"],
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
            return $this->sendResponse(new ShowOrdersResource($order->load('tickets')), 'Order successfully created');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $order)
    {
        $response = Orders::with(['kasir', 'tickets.shop', 'tickets.details', 'tickets.details.product'])->where('slug', $order->slug)->first();
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
                "BuyerName" => $validated["BuyerName"] ?? NULL,
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
            return $this->sendResponse(new ShowOrdersResource($order->load('tickets')), 'Order successfully updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $order)
    {
        $order->delete();
        return $this->sendResponse(new OrderResource($order), "Order Successfully Deleted");
    }
}
