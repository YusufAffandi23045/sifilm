<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieAdminApiController;
use App\Http\Controllers\AdminAuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [MovieController::class, 'index']);

Route::post('/admin/register', [AdminAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'loginApi']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('admin/', [MovieAdminApiController::class, 'index']);
    Route::get('admin/{id}', [MovieAdminApiController::class, 'show']);
    Route::post('admin/', [MovieAdminApiController::class, 'store']);
    Route::put('admin/{id}', [MovieAdminApiController::class, 'update']);
    Route::delete('admin/{id}', [MovieAdminApiController::class, 'destroy']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logoutApi']);
});
Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');