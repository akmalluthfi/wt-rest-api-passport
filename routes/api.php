<?php

use App\Http\Controllers\BookController;
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


// Route::middleware('auth:api')->group(function () {
Route::get('user', function (Request $request) {
    return $request->user();
});

Route::apiResource('books', BookController::class)->missing(function (Request $request) {
    return response()->json([
        'message' => 'Cannot found book with id: ' . $request->route('book')
    ], 404);
});
// });
