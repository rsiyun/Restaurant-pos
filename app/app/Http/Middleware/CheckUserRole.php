<?php

namespace App\Http\Middleware;

use App\Endpoint\ApiUrl;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
         $token = session('user.access_token');
         $response = Http::withToken($token)->get(ApiUrl::$api_url."/user/token");
         if ($response->successful() && in_array($response["data"]['role'], $roles)) {
             return $next($request);
         }
         return redirect()->route('login')->with('error', 'Unauthorized. You do not have permission to access this resource.');
    }
}
