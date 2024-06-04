<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/order")->json();
        $profile = SessionService::user();
        if ($response["success"]) {
            return view('cpanel.order.index', [
                "profile" => $profile,
                ...$response
            ]);
        }
    }
    public function create()
    {
        $response = Http::get(ApiUrl::$api_url . "/unpaymentTicket")->json();
        $user = SessionService::user();
        if ($response["success"]) {
            return view('cpanel.order.create', [
                "profile" => $user,
                'tickets' => $response['data']
            ]);
        }
    }
    public function edit($slug)
    {
        $oldDataOrder = Http::get(ApiUrl::$api_url . "/order". "/$slug")->json();
        $user = SessionService::user();
        $ticketList = Http::get(ApiUrl::$api_url . "/unpaymentTicket", ["idOrder" => $oldDataOrder["data"]["idOrder"]])->json();
        $success = $ticketList["success"] && $oldDataOrder["success"];
        $response = [
            "idKasir" => $oldDataOrder["data"]["kasir"]["idKasir"],
            "slug" => $oldDataOrder["data"]["slug"],
            "totalOrder" => $oldDataOrder["data"]["totalOrder"],
            "buyerName" => $oldDataOrder["data"]["buyerName"],
            "oldTickets" => $oldDataOrder["data"]["tickets"],
            "unPayment" => [
                ...$ticketList["data"]
            ],
            "success" => $success
        ];
        if ($response["success"]) {
            return view('cpanel.order.update', [
                "profile" => $user,
                ...$response
            ]);
        }

    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            "tickets" => "required|array",
        ]);
        $user = SessionService::user();
        $newTicket = [];
        foreach ($request->tickets as $ticket) {
            $newTicket["tickets"][] = ["slugTicket" => $ticket];
        }
        $req_api = [
            "idKasir" => $user["idUser"],
            "buyerName" => $request->buyerName ?? null,
            ...$newTicket
        ];

        $response = Http::put(ApiUrl::$api_url . "/order"."/$slug", $req_api)->json();

        if ($response["success"]) {
            return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        }
    }

    public function show($slug)
    {

        $response = Http::get(ApiUrl::$api_url . "/order" . "/$slug")->json();
        $user = SessionService::user();
        if ($response["success"]) {
            return view('cpanel.order.show', [
                "profile" => $user,
                ...$response
            ]);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            "tickets" => "required|array",
        ]);
        $user = SessionService::user();
        $newTicket = [];
        foreach ($request->tickets as $ticket) {
            $newTicket["tickets"][] = ["slugTicket" => $ticket];
        }
        $req_api = [
            "idKasir" => $user["idUser"],
            "buyerName" => $request->buyerName,
            ...$newTicket
        ];
        $response = Http::post(ApiUrl::$api_url . "/order", $req_api)->json();

        if ($response["success"]) {
            return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        }

    }
    public function destroy($slug)
    {
        $response = Http::delete(ApiUrl::$api_url . "/order/$slug")->json();
        if ($response["success"]) {
            return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        }
    }
}
