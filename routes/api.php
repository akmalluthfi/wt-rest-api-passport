<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('books', BookController::class)->missing(function (Request $request) {
        return response()->json([
            'message' => 'Cannot found book with id: ' . $request->route('book')
        ], 404);
    });

    Route::apiResource('products', ProductController::class)->missing(function (Request $request) {
        return response()->json([
            'message' => 'Cannot found product with id: ' . $request->route('product')
        ], 404);
    });
});
