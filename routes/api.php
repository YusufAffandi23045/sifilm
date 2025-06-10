<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieApiController;
use App\Http\Controllers\MovieAdminApiController;
use App\Http\Controllers\GenreApiController;
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

Route::get('/', [MovieApiController::class, 'index']);

Route::post('/admin/register', [AdminAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'loginApi']);

Route::middleware('jwt.auth')->group(function () {

    Route::get('admin/', [MovieAdminApiController::class, 'index']);
    Route::post('admin/', [MovieAdminApiController::class, 'store']);
    Route::put('admin/{id}', [MovieAdminApiController::class, 'update']);
    Route::delete('admin/{id}', [MovieAdminApiController::class, 'destroy']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logoutApi']);

    Route::get('admin/genre', [GenreApiController::class, 'index']);
    Route::post('admin/genre', [GenreApiController::class, 'store']);
    Route::put('admin/genre/{id}', [GenreApiController::class, 'update']);
    Route::delete('admin/genre/{id}', [GenreApiController::class, 'destroy']);

    Route::get('admin/{id}', [MovieAdminApiController::class, 'show']);
    Route::get('admin/genre/{id}', [GenreApiController::class, 'show']);
});
Route::get('/{id}', [MovieApiController::class, 'show'])->name('movies.show');
