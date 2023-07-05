<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Notifications\SentMessage;

class ChatController extends Controller
{
    public function index():View
    {
        $users = User::where('id', '!=', auth()->id())->latest()->filter(request(['search']))->get();
        // id of the latest user that is not the authenticated user
        $recepient_id = User::where('id', '!=', auth()->id())->orderBy('created_at', 'desc')->value('id');
        $messages = Message::where('user_id', auth()->id())->where('recepient_id', $recepient_id)->orwhere('user_id', $recepient_id)->where('recepient_id', auth()->id())->oldest()->get();
    
        return view('chat.index', compact('users', 'messages', 'recepient_id'));
    }

    public function show(User $recepient):View {
        $recepient_id = $recepient->id;
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        $messages = Message::where('user_id', auth()->id())->where('recepient_id', $recepient_id)->orwhere('user_id', $recepient_id)->where('recepient_id', auth()->id())->oldest()->get();

        return view('chat.show', compact('messages', 'recepient_id', 'users'));
    }

    public function store(ChatRequest $chatRequest):Message
    {
        $formField = $chatRequest->validated();

        $formField['user_id'] = auth()->id();

        $message = Message::create($formField);
        event(new SentMessage($message));

        return $message;
    }
}
