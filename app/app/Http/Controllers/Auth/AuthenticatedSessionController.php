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
    // public function store(Request $request)
    //     {
    //         $response = Http::post(ApiUrl::$api_url."/login", [
    //             'email' => $request->email,
    //             'password' => $request->password
    //         ])->json();
    //         if ($response["success"]) {
    //             SessionService::setToken($response["data"]["access_token"]);
    //             return redirect("/dashboard");
    //         }
    //         return redirect()->route("login")->with($response);
    //     }

    public function store(Request $request)
    {
        $response = Http::post(ApiUrl::$api_url . "/login", [
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($response->failed()) {
            $errors = $response->json()["error"]["description"];
            if (!is_array($errors)) {
                return redirect()->route("login")->withErrors(["message" => "Login Gagal Password Salah"])->withInput();
            }
            return redirect()->route("login")->withErrors($errors)->withInput();

        }

        $user = $response->json()["data"];
        if ($user["role"] == "ShopEmployee" && $user["idShop"] == null) {
            return redirect()->route("login")->withErrors(["message" => "Login gagal harap hubungi admin"])->withInput();
        }
        SessionService::setToken($user["access_token"]);
        $user = SessionService::user();
        if ($user["role"] == "ShopEmployee") {
            return redirect("/");
        }
        return redirect("/dashboard");

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
