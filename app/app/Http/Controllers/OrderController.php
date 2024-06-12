<?php

namespace App\Http\Controllers;

use App\Endpoint\ApiUrl;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index()
    {
        $profile = SessionService::user();
        $token = session('user.access_token') ?? "";
        if (!$token) {
            return redirect("/login")->withErrors(["message" => "silahkan login terlebih dahulu"]);
        }
        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/order");

        if ($response->successful()) {
            $res = $response->json();
            return view('cpanel.order.index', [
                "profile" => $profile,
                ...$res
            ]);
        }
    }
    public function create()
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";
        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/unpaymentTicket")->json();

        if ($response["success"]) {
            return view('cpanel.order.create', [
                "profile" => $user,
                'tickets' => $response['data']
            ]);
        }
    }
    public function edit($slug)
    {
        $token = session('user.access_token') ?? "";
        $oldDataOrder = Http::withToken($token)->get(ApiUrl::$api_url . "/order" . "/$slug")->json();
        $user = SessionService::user();
        $ticketList = Http::withToken($token)->get(ApiUrl::$api_url . "/unpaymentTicket", ["idOrder" => $oldDataOrder["data"]["idOrder"]])->json();
        $success = $ticketList["success"] && $oldDataOrder["success"];
        $response = [
            "idKasir" => $oldDataOrder["data"]["kasir"]["idKasir"],
            "slug" => $oldDataOrder["data"]["slug"],
            "totalOrder" => $oldDataOrder["data"]["totalOrder"],
            "buyerName" => $oldDataOrder["data"]["buyerName"],
            "oldTickets" => $oldDataOrder["data"]["tickets"],
            "unPayment" => $ticketList["data"],
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
        try {
            $request->validate([
                'tickets' => 'required|array',
            ]);
    
            // Lakukan tindakan jika validasi berhasil
        } catch (ValidationException $e) {
            // Menangani error validasi
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors(["message" => "Tiket wajib dipilih"]);
        }
        $token = session('user.access_token') ?? "";
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
                
                // dd("test");
        $response = Http::withToken($token)->put(ApiUrl::$api_url . "/order" . "/$slug", $req_api);
        if ($response->failed()){
            $errors = $response->json()["error"]["description"];
            // dd($errors);
            return redirect()->back()->withErrors($errors)->withInput();
        }
        // if ($response["success"]) {
            return redirect('/dashboard/order');
        // }
    }

    public function show($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->get(ApiUrl::$api_url . "/order" . "/$slug")->json();
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
        try {
            $request->validate([
                'tickets' => 'required|array',
            ]);
    
            // Lakukan tindakan jika validasi berhasil
        } catch (ValidationException $e) {
            // Menangani error validasi
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors(["message" => "Tiket wajib dipilih"]);
        }
        // dd($request->);
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $newTicket = [];
        foreach ($request->tickets as $ticket) {
            $newTicket["tickets"][] = ["slugTicket" => $ticket];
        }
        $req_api = [
            "idKasir" => $user["idUser"],
            "buyerName" => $request->buyerName,
            ...$newTicket
        ];
        $response = Http::withToken($token)->post(ApiUrl::$api_url . "/order", $req_api);
        if ($response->failed()){
            $errors = $response->json()["error"]["description"];
            // dd($errors);
            return redirect()->back()->withErrors($errors)->withInput();
        }
        // if ($response["success"]) {
        //     return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        // }

    }
    public function destroy($slug)
    {
        $user = SessionService::user();
        $token = session('user.access_token') ?? "";

        $response = Http::withToken($token)->delete(ApiUrl::$api_url . "/order/$slug")->json();
        if ($response["success"]) {
            return redirect('/dashboard/order')->with(["message" => $response["messages"]]);
        }
    }
}
