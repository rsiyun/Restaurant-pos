<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketDetails;
use App\Http\Resources\Tickets\TicketDetailResource;

class TicketDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketDetails::all();

        if ($tickets->isEmpty()) {
            return $this->sendError('TicketDetail does not exist.');
        }

        return $this->sendResponse(TicketDetailResource::collection($tickets), 'All Data TicketDetails Successfully Retrieved');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $ticketDetails = TicketDetails::where('slug', $slug)->with('product')->first();

        if (!$ticketDetails) {
            return $this->sendError('TicketDetail not found.');
        }

        return $this->sendResponse(new TicketDetailResource($ticketDetails), "TicketDetail Successfully Retrieved");
    }
}
