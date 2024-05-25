<?php

namespace App\Http\Controllers\Auth;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use App\Services\SessionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url."/login", [
            'email' => $request->email,
            'password' => $request->password
        ])->json();
        if ($response["success"]) {
            SessionService::setToken($response["data"]["access_token"]);
            return redirect("/dashboard");
        }
        return redirect()->route("login")->with($response);
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(): RedirectResponse
    {

        $logout = SessionService::logout();
        if ($logout) {
            return redirect("/login");
        }
        return redirect()->back();
    }
}
