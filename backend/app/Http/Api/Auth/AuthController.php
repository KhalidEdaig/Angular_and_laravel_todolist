<?php

namespace App\Http\Api\Auth;

use App\Http\Api\ResponseController;
use App\Http\Api\User\Resources\Base\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends ResponseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api_' . $this->type_user);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {
        return $this->createNewToken(Auth::refresh());
    }


    public function me()
    {
        return response()->json(new UserResource(Auth::user()));
    }


    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            //'user' => new UserResource(Auth::user())
        ]);
    }

    
}
