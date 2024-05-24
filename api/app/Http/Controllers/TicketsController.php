<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Tickets\CreateRequest;
use App\Http\Requests\Tickets\UpdateRequest;
use App\Http\Resources\Tickets\ShowTicketResource;
use App\Http\Resources\Tickets\TicketResource;
use App\Models\Product;
use App\Models\Tickets;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Tickets::paginate(9);
        $response = [
            "tickets" => TicketResource::collection($tickets),
            'links' => [
                'first' => $tickets->url(1),
                'last' => $tickets->url($tickets->lastPage()),
                'prev' => $tickets->previousPageUrl(),
                'next' => $tickets->nextPageUrl(),
            ],
        ];
        return $this->sendResponse($response, "Tickets Successfully Retrieved");
    }
    public function unpayment(Request $request)
    {
        $validated = $request->validate([
            "search" => "nullable|string"
        ]);
        $tickets = Tickets::where("idOrder", NULL)->paginate(9);
        if ($validated["search"] ?? NULL != NULL) {
            $tickets = Tickets::where("idOrder", NULL)->where("slug", "like", '%' . $validated["search"] . '%')->paginate(5);
        }
        $response = [
            "tickets" => TicketResource::collection($tickets),
            'links' => [
                'first' => $tickets->url(1),
                'last' => $tickets->url($tickets->lastPage()),
                'prev' => $tickets->previousPageUrl(),
                'next' => $tickets->nextPageUrl(),
            ],
        ];
        return $this->sendResponse($response, "Tickets Successfully Retrieved");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {

            $slugTicket = Helper::generateSlug("t", "tickets");
            $ticket = Tickets::create([
                "idShop" => $validated["idShop"],
                "orderNote" => $validated["orderNote"],
                "priceTickets" => 1,
                "slug" => $slugTicket
            ]);
            foreach ($validated["ticketCart"] as $ticketCart) {
                $priceTicketDetail = 0;
                $slug_material_detail = "td" . "-" . $ticket->idTicket;
                $slugDetail = Helper::generateSlug($slug_material_detail, "ticket_details");
                $product = Product::where('slug', $ticketCart["slugProduct"])->first();
                $priceTicketDetail += $ticketCart["quantity"] * $product->productPrice;
                $ticket->details()->create([
                    "priceTicketDetail" => $priceTicketDetail,
                    "idProduct" => $product->idProduct,
                    "slug" => $slugDetail,
                    "quantity" => $ticketCart["quantity"]
                ]);
            }
            $totalTicket = array_reduce($ticket->load('details')->details->toArray(), function ($carry, $item) {
                return $carry + ($item['priceTicketDetail']);
            }, 0);
            $ticket->update([
                "priceTickets" => $totalTicket
            ]);

            DB::commit();
            return $this->sendResponse(new ShowTicketResource($ticket->load('details')), "Ticket created successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $response = Tickets::with(['details'])->where('slug', $slug)->first();
        return $this->sendResponse(new ShowTicketResource($response), "Get a Product");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Tickets $ticket)
    {
        $validated = $request->validated();
        if ($ticket->idOrder != NULL) {
            throw new HttpResponseException(response([
                "message" => "Cannot edit this data",
                "success" => false,
                "error" => [
                    "code" => 400,
                    "description" => "cannot edit this data because this tickets has been pay"
                ]
            ], 400));
        }

        DB::beginTransaction();

        try {
            $ticket->update([
                "orderNote" => $validated["orderNote"] ?? $ticket->orderNote,
                "priceTickets" => 1
            ]);
            $ticket->details()->delete();
            foreach ($validated["ticketCart"] as $ticketCart) {
                $priceTicketDetail = 0;
                $slug_material_detail = "td" . "-" . $ticket->idTicket;
                $slugDetail = Helper::generateSlug($slug_material_detail, "ticket_details");
                $product = Product::where('slug', $ticketCart["slugProduct"])->first();
                $priceTicketDetail += $ticketCart["quantity"] * $product->productPrice;
                $ticket->details()->create([
                    "slug" => $slugDetail,
                    "priceTicketDetail" => $priceTicketDetail,
                    "idProduct" => $product->idProduct,
                    "quantity" => $ticketCart["quantity"]
                ]);
            }
            $totalOrder = array_reduce($ticket->load('details')->details->toArray(), function ($carry, $item) {
                return $carry + ($item['priceTicketDetail']);
            }, 0);
            $ticket->update([
                "priceTickets" => $totalOrder
            ]);
            DB::commit();
            return $this->sendResponse(new ShowTicketResource($ticket->load('details')), 'Ticket successfully updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $ticket = Tickets::where('slug', $slug)->first();
        if (!$ticket) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        DB::beginTransaction();

        try {
            $ticket->details()->delete();
            $ticket->delete();

            DB::commit();
            return response()->json(['message' => 'Order deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete order', 'error' => $e->getMessage()], 500);
        }
    }
}
