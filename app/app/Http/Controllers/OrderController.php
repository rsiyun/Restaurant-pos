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
    public function edit(Request $request, $slug)
    {
        $search = $request->search ?? "";
        $page = $request->page ?? "";
        $ticketList = Http::get(ApiUrl::$api_url . "/unpaymentTicket", ["search" => $search, "page" => $page])->json();
        $oldDataOrder = Http::get(ApiUrl::$api_url . "/order". "/$slug")->json();
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

        // http://127.0.0.1:8001/api/orders/o-8BMBY
        $response = Http::get(ApiUrl::$api_url . "/order" . "/$slug")->json();
        if ($response["success"]) {
            return view('cpanel.order.show', [
                ...$response
            ]);
        }

    }
    public function update(Request $request, $slug)
    {
        $response = Http::post(ApiUrl::$api_url . "/order", $request->all())->json();

        if ($response["success"]) {
            return view('cpanel.order.index', [
                ...$response
            ]);
        }
    }
    public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url . "/order", $request->all())->json();

        if ($response["success"]) {
            return view('cpanel.order.index', [
                ...$response
            ]);
        }

        // return response()->json($response);

        // return redirect()->route('/dashboards/order')->with('success', 'Order successfully created');
    }
    public function destroy($slug)
    {
        $response = Http::delete(ApiUrl::$api_url . "/order/$slug")->json();
        if ($response["success"]) {
            return view('cpanel.order.index', [
                ...$response
            ]);
        }
    }
}
