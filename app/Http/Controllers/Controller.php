<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function created($data)
    {
        return response($data, 201);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'         => JWTAuth::user(),
        ]);
    }

//    public function toArray($success = true, $data = [], $message)
//    {
//        return compact('success', 'data', 'message');
//    }
//
//    public function success($data = [], $message = '')
//    {
//        return $this->toArray(true, $data, $message);
//    }
//
//    public function error($data = [], $message)
//    {
//        return $this->toArray(false, $data, $message);
//    }
}
