<?php

namespace App\Http\Controllers\Auth;

use App\Endpoint\ApiUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($response["status"]) {
            $session = [
                "access_token" => $response["data"]["access_token"]
            ];
            session(["user" => $session]);
            return redirect()->route("dashboard");
        }
        return redirect()->route("login")->with($response);
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
