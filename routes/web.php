<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Show register form for a user
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Store user
Route::post('/users', [UserController::class, 'store']);

//Show login form for a user
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Authenticate user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show edit form
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');

//Update user
Route::put('/users/{user}', [UserController::class, 'update']);

//delete user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');