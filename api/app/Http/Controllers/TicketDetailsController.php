<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
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
        $ticketDetails = TicketDetails::all();
        $response = [
            "ticketDetails" => TicketDetailResource::collection($ticketDetails),
            'links' => [
                'first' => Helper::getParams($ticketDetails->url(1))["page"] ?? null,
                'last' => Helper::getParams($ticketDetails->url($ticketDetails->lastPage()))["page"] ?? null,
                'prev' => Helper::getParams($ticketDetails->previousPageUrl())["page"] ?? null,
                'next' => Helper::getParams($ticketDetails->nextPageUrl())["page"] ?? null,
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
            return $this->sendError('TicketDetail not found.', [], 404);
        }

        return $this->sendResponse(new TicketDetailResource($ticketDetails), "TicketDetail Successfully Retrieved");
    }
}
