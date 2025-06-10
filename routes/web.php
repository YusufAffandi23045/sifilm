<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieAdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreAdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\YearController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('index');
Route::get('/search', [MovieController::class, 'search'])->name('movies.search');

Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/{name}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/year', [YearController::class, 'index'])->name('year.index');
Route::get('/year/{year}', [YearController::class, 'show'])->name('year.show');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.loginWeb');
Route::post('/admin/login', [AdminAuthController::class, 'loginWeb']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::post('/admin/register', [AdminAuthController::class, 'register']);

Route::middleware('admin.auth')->group(function () {
    //index
    Route::get('/admin', [MovieAdminController::class, 'index']);
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/genres', [GenreAdminController::class, 'index']);

    //store
    Route::get('/admin/create', [MovieAdminController::class, 'create']);
    Route::post('/admin', [MovieAdminController::class, 'store']);

    Route::get('/admin/categories/create', [CategoryController::class, 'create']);
    Route::post('/admin/categories', [CategoryController::class, 'store']);

    Route::get('/admin/genres/create', [GenreAdminController::class, 'create']);
    Route::post('/admin/genres', [GenreAdminController::class, 'store']);

    //show
    Route::get('/admin/{id}', [MovieAdminController::class, 'show'])->name('admin.show');

    //edit
    Route::get('/admin/{id}/edit', [MovieAdminController::class, 'edit']);
    Route::put('/admin/{id}', [MovieAdminController::class, 'update']);
    
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);

    Route::get('/admin/genres/{id}/edit', [GenreAdminController::class, 'edit']);
    Route::put('/admin/genres/{id}', [GenreAdminController::class, 'update']);

    //hapus
    Route::delete('/admin/{id}', [MovieAdminController::class, 'destroy']);

    Route::put('/admin/categories/{id}', [CategoryController::class, 'destroy']);

    Route::put('/admin/genres/{id}', [GenreAdminController::class, 'destroy']);
});

Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');