<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Models\Friend;

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
Route::get('/payment', [UserController::class, 'payment']);


Route::middleware([auth::class])->group(function () {
    Route::get('/', [FriendController::class, 'home']);
    Route::get('/search', [FriendController::class, 'search']);
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/checkLike/{candidateId}', [FriendController::class, 'checkLike']);
});



