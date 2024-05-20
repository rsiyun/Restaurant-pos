<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    function index()
    {
        $productAPI = Http::get('http://localhost:8001/api/products');

        return view('products.index', ['products' => $productAPI->json()]);
    }

    function create()
    {
        return view('products.create');
    }
}
