<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Notifications\SentMessage;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function show(){

    }

    public function store(Request $request)
    {
        $formField = $request->validate([
            'message' => ['required', 'string'],
            'recepient_id' => ['required'],
        ]);

        $formField['user_id'] = auth()->id();

        $message = Message::create($formField);
        event(new SentMessage($message));
    }
}
