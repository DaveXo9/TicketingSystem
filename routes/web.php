<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

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
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('status', StatusController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('tickets', TicketController::class);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/users/authenticate', [UserController::class, 'authenticate']);
    Route::post('/users', [UserController::class, 'store']);
});

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');

Route::get('/', [TicketController::class, 'openTickets'])->middleware('auth');

