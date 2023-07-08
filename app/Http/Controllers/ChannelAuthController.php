<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class ChannelAuthController extends Controller
{
    public function authenticate (Request $request) 
    {
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
    
        $userId = auth()->id();
    
        if (auth()->check() && auth()->user()->id == $userId) {
            $auth = $pusher->socket_auth($channel_name, $socket_id);
            return response($auth);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
