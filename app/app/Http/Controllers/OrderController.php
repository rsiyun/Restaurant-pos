<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $response = Http::get(ApiUrl::$api_url . "/order")->json();
        return response()->json($response);
    }
    public function create()
    {
        return view('dashboard.order.create');
    }
    public function edit()
    {

    }
    public function show($slug)
    {

        // http://127.0.0.1:8001/api/orders/o-8BMBY
        $response = Http::get(ApiUrl::$api_url . "/order" . "/$slug")->json();
        dd($response);
        die;

    }
    public function update($id)
    {

    }
    public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url . "/order", $request->all())->json();
        return response()->json($response);

        // return redirect()->route('/dashboards/order')->with('success', 'Order successfully created');
    }
    public function destroy($slug)
    {
        $response = Http::delete(ApiUrl::$api_url . "/order/$slug")->json();
        return response()->json($response);

        // return redirect()->route('/dashboards/order')->with('success', 'Order successfully deleted');
    }
}
