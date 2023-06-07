<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;

use Illuminate\Http\Request;
use Pusher\Pusher;
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
    
    Route::get('/notifications', [NotificationController::class, 'index']); 
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
    Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
    Route::get('/', [TicketController::class, 'openTickets'])->middleware('auth');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/users/authenticate', [UserController::class, 'authenticate']);
    Route::post('/users', [UserController::class, 'store']);
});



Route::post('/broadcasting/auth', function (Request $request) {
    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]
    );

    $socket_id = $request->socket_id;
    $channel_name = $request->channel_name;

    // Extract the user ID from the channel name
    $userId = str_replace('private-notifications.', '', $channel_name);

    // Compare with the logged-in user ID
    if (auth()->check() && auth()->user()->id == $userId) {
        $auth = $pusher->socket_auth($channel_name, $socket_id);
        return response($auth);
    }

    return response()->json(['message' => 'Unauthorized'], 403);
});