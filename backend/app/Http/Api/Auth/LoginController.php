<?php

namespace App\Http\Api\Auth;

use App\Enums\eRespCode;
use App\Http\Api\Auth\Requests\LoginValidation;
use App\Http\Api\ResponseController;
use App\Http\Api\User\Resources\Base\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends ResponseController
{


    public function __construct()
    {
        parent::__construct(); 
        Auth::shouldUse('api_user');
    }

    public function login(LoginValidation $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!$token = Auth::attempt($credentials)) {

                return response()->json([
                    'errors' => [
                        'email' => ['Your email and/or password may be incorrect.']
                    ]
                ], 422);
            }
        } catch (JWTException $e) {
            return $this->resp->guessResponse(eRespCode::_403_NOT_AUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return $this->resp->ok(
            eRespCode::_200_OK,
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => new UserResource(Auth::user()),
                'type' => 'user'
            ]
        );
    }
}
