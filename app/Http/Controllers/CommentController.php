<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Get comments for a single ticket
    public function index($ticket_id){
        $comments = Comment::where('ticket_id', $ticket_id)->latest();
        return $comments;
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'comment' => 'required'
        ]);

        $formFields['user_id'] = auth()->id;
        $formFields['ticket_id'] = $request->ticket_id;

        Comment::create($formFields);

        return back()->with('message', 'Comment created');
    }

    public function edit(Comment $comment){
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment){
        $formField = $request->validate([
            'comment' => 'required'
        ]);

        if($comment->user_id != auth()->id){
            abort(403, 'Unauthorized Action');
        }else{

            $comment->update($formField);
        }


        return back()->with('message', 'Comment updated');
    }

    public function destroy(Comment $comment){
        if($comment->user_id != auth()->id){
            abort(403, 'Unauthorized Action');
        }else{
            $comment->delete();
        }

        return back()->with('message', 'Comment deleted');
    }
}
