<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUser;
use App\Models\Wedding;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/login', [UserController::class, 'storeLogin']);
Route::get('/login', [UserController::class, 'getLogin'])->name('login');
Route::post('/register', [UserController::class, 'storeRegister']);
Route::get('/register', [UserController::class, 'getRegister']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware([auth::class])->group(function () {
    Route::get('/', [WeddingController::class, 'home']);
    Route::get('/wedding', [WeddingController::class, 'showAll']);
    Route::get('/wedding/{location?}', [WeddingController::class, 'showAll']);
    Route::get('/checkout/{id}', [WeddingController::class, 'checkout']);
    Route::post('/checkout', [WeddingController::class, 'storeCheckout']);
    Route::get('/checkLike/{candidateId}', [WeddingController::class, 'checkLike']);
});

Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::post('/edit', [DashboardController::class, 'edit']);
    Route::post('/changeBanned', [DashboardController::class, 'changeBanned']);
});



