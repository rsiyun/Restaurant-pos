<?php

namespace App\Services;

use App\Endpoint\ApiUrl;
use Illuminate\Support\Facades\Http;

class SessionService{
    private static $token;
    public function __construct($token = null)
    {
        self::$token = $token;
    }
    public static function image_url(){
        return "http://localhost:8001/storage/";
    }
    public static function user(){
        $token = self::$token ?? session('user.access_token');
        if (!$token) {
            return null;
        }
        $response = Http::withToken($token)->get(ApiUrl::$api_url ."/user/token");
        if (!$response["success"]) {
            return null;
        }
        return $response["data"];
    }
    public static function logout(){
        if (!session()->has('user')) {
            return false;
        }
        $token = self::$token ?? session('user.access_token');
        $response = Http::withToken($token)->post(ApiUrl::$api_url ."/logout");
        if (!$response["success"]) {
            return false;
        }
        session()->flush();
        return true;
    }
    public static function setToken($token){
        $session = [
            "access_token" => $token
        ];
        session(["user" => $session]);
        self::$token = $token;
    }
}

?>
