<?php

use App\Http\Api\Auth\AuthController;
use App\Http\Api\Auth\LoginController;
use App\Http\Api\Auth\PasswordController;
use App\Http\Api\Auth\RegisterController;
use App\Http\Api\Category\CategoryController;
use App\Http\Api\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return response()->json([
      'status' => 200,
      'project' => 'RESTAPILARAVEL-SOLID-ARCHITETURE',
      'massage' => 'Welcome to my project and let\'s go to build together amazing rest api'
  ]);
});

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'

], function ($router) {
  Route::post('{guard}/register', [RegisterController::class, 'register']);
  Route::post('{guard}/login', [LoginController::class, 'login']);
  Route::post('{guard}/logout', [AuthController::class, 'logout']);
  Route::post('{guard}/refresh', [AuthController::class, 'refresh']);
  Route::get('{guard}/me', [AuthController::class, 'me']);
  Route::put('{guard}/password/change', [PasswordController::class, 'changePassword']);
});


Route::group([
  'middleware' => ['api', 'manage_token:api_user,super_admin'],
], function () {
});

Route::group([
  'middleware' => ['api', 'manage_token:api_user,super_admin|admin|moderator|editor|user|'],
], function () {
 
});
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tasks', TaskController::class);
Route::post('tasks/all', [TaskController::class,'all']);
Route::post('tasks/filtered', [TaskController::class,'filteredTasks']);
Route::put('tasks/{id}/change/status', [TaskController::class,'changeStatus']);