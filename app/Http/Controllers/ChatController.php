<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SentMessage;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        // id of the latest user that is not the authenticated user
        $recepient_id = User::where('id', '!=', auth()->id())->first()->id;
        // $messages = Message::where('user_id', auth()->id())->where('recepient_id', $recepient_id)->latest()->get();


        return view('chat.index', compact('users'));
    }

    public function show(User $recepient){
        $recepient_id = $recepient->id;
        $messages = Message::where('user_id', auth()-id())->where('recepient_id', $recepient->id)->latest()->get();

        return view('chat.show', compact('messages', 'recepient_id'));
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
