<?php

namespace App\Http\Api\Auth;
use App\Enums\eRespCode;
use App\Http\Api\Auth\Requests\changePasswordValidation;
use App\Http\Api\ResponseController;
use App\Models\User;


class PasswordController extends ResponseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api_user');
    }

    public function changePassword(changePasswordValidation $request)
    {
        $user = User::find(auth()->user()->id);

        if (!Hash::check($request->old_password, $user->password))
            return $this->resp->guessResponse(eRespCode::_403_NOT_AUTHORIZED);

        $user->password = $request->password;

        if ($user->save())
            return $this->resp->ok(eRespCode::_200_OK);

        return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
    }
}