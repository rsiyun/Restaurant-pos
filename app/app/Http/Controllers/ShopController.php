<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\SessionService;

class ShopController extends Controller
{
    public function index()
    {
        $user = SessionService::user();
        return view('cpanel.main.shop', [
            "profile" => $user
        ]);
    }

}
