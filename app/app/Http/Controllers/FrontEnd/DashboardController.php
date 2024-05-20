<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $productAPI = Http::get('http://localhost:8001/api/products');

        $transactionAPI = Http::get('http://localhost:8001/api/transactions');

        return view('dashboard', [
            'products' => $productAPI->json(),
            'transactions' => $transactionAPI->json()
        ]);
    }
}