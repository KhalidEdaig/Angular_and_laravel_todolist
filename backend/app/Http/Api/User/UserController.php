<?php

namespace App\Http\Api\User;

use App\Http\Api\ResponseController;

class UserController extends ResponseController
{


  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth:api_user');
  }

 
}
