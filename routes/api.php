<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->group(function () {
	Route::middleware('auth')->group(function () {
		Route::post('create', [AdminController::class, 'create']);
		Route::get('logout', [AdminController::class, 'logout']);
	});
	Route::post('login', [AdminController::class, 'login'])->middleware('guest');
});
