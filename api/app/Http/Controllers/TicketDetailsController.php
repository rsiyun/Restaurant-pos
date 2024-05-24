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
        $ticketDetails = TicketDetails::paginate(9);
        $response = [
            "ticketDetails" => TicketDetailResource::collection($ticketDetails),
            'links' => [
                'first' => $ticketDetails->url(1),
                'last' => $ticketDetails->url($ticketDetails->lastPage()),
                'prev' => $ticketDetails->previousPageUrl(),
                'next' => $ticketDetails->nextPageUrl(),
            ],
        ];

        return $this->sendResponse($response, 'All Data TicketDetails Successfully Retrieved');
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
