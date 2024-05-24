<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? "";
        $response = Http::get(ApiUrl::$api_url . "/order", ["page" => $page])->json();
        if ($response["success"]) {
            return view('cpanel.order.index', [
                ...$response
            ]);
        }
    }
    public function create()
    {
        $response = Http::get(ApiUrl::$api_url . "/unpaymentTicket")->json();

        if ($response["success"]) {
            return view('cpanel.order.create', [
                'tickets' => $response['data']['tickets']
            ]);
        }
    }
    public function edit($slug)
    {
        $oldDataOrder = Http::get(ApiUrl::$api_url . "/order". "/$slug")->json();
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
                ...$response
            ]);
        }

    }
    public function show($slug)
    {

        $response = Http::get(ApiUrl::$api_url . "/order" . "/$slug")->json();
        if ($response["success"]) {
            return view('cpanel.order.show', [
                ...$response
            ]);
        }

    }
    public function update(Request $request, $slug)
    {
        $request->validate([
            "tickets" => "required|array",
        ]);
        $newTicket = [];
        foreach ($request->tickets as $ticket) {
            $newTicket["tickets"][] = ["slugTicket" => $ticket];
        }
        $req_api = [
            "idKasir" => 3,
            "buyerName" => $request->buyerName ?? null,
            ...$newTicket
        ];

        $response = Http::put(ApiUrl::$api_url . "/order"."/$slug", $req_api)->json();

        if ($response["success"]) {
            return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            "tickets" => "required|array",
        ]);
        $newTicket = [];
        foreach ($request->tickets as $ticket) {
            $newTicket["tickets"][] = ["slugTicket" => $ticket];
        }
        $req_api = [
            "idKasir" => 3,
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
