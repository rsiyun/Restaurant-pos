<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {

    }
    public function create(){

    }
    public function edit(){

    }
    public function show($slug){

        // http://127.0.0.1:8001/api/orders/o-8BMBY
        $response = Http::get(ApiUrl::$api_url."/orders"."/$slug")->json();
        dd($response);
        die;

    }
    public function update($id){

    }
    public function store(){

    }
    public function destroy($id){

    }
}
