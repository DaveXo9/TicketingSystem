<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $formFields = $request->validate([
            'comment' => 'required'
        ]);

        $formFields['user_id'] = auth()->user()->id;
        $formFields['ticket_id'] = $request->ticket_id;

        Comment::create($formFields);

        return back()->with('message', 'Comment created');
    }
}
