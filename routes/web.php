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

//-------------------------------------------------------------------------------------------

// Show client list
Route::get('/clients', [ClientController::class, 'index'])->middleware('auth');

// Show update client form
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->middleware('auth');

// Update client
Route::put('/clients/{client}', [ClientController::class, 'update'])->middleware('auth');

// Delete client
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->middleware('auth');

//-------------------------------------------------------------------------------------------

// Show status list
Route::get('/status', [StatusController::class, 'index'])->middleware('auth');

// Show create status form
Route::get('/status/create', [StatusController::class, 'create'])->middleware('auth');

// Store status
Route::post('/status', [StatusController::class, 'store'])->middleware('auth');

// Show update status form
Route::get('/status/{status}/edit', [StatusController::class, 'edit'])->middleware('auth');

// Update status
Route::put('/status/{status}', [StatusController::class, 'update'])->middleware('auth');

// Delete status
Route::delete('/status/{status}', [StatusController::class, 'destroy'])->middleware('auth');

//-------------------------------------------------------------------------------------------

// Create comment
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

// Show update comment form
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware('auth');

// Update comment
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('auth');

// Delete comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth');


//-------------------------------------------------------------------------------------------

// Show ticket list
Route::get('/tickets', [TicketController::class, 'index'])->middleware('auth');

// Show open ticket list
Route::get('/tickets/open', [TicketController::class, 'openTickets'])->middleware('auth');

// Show create ticket form
Route::get('/tickets/create', [TicketController::class, 'create'])->middleware('auth');

// Store ticket
Route::post('/tickets', [TicketController::class, 'store'])->middleware('auth');

// Show update ticket form
Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->middleware('auth');

// Update ticket
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->middleware('auth');

// Delete ticket
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->middleware('auth');

//-------------------------------------------------------------------------------------------