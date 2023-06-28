<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests\CommentRequest;


class CommentController extends Controller
{
    // Get comments for a single ticket
    public function index($ticket_id):Collection{
        $comments = Comment::where('ticket_id', $ticket_id)->latest();
        return $comments;
    }

    public function store(CommentRequest $commentRequest):RedirectResponse{
        $formFields = $commentRequest->validated();

        $formFields['user_id'] = auth()->id();

        Comment::create($formFields);

        return back()->with('message', 'Comment created');
    }

    public function edit(Comment $comment):View{
        return view('comment.edit', compact('comment'));
    }

    public function update(CommentRequest $commentRequest, Comment $comment):RedirectResponse{
        $formField = $commentRequest->validated(); 

        if($comment->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }else{

            $comment->update($formField);
        }


        return redirect('/tickets/' . $comment->ticket_id)->with('message', 'Comment updated');    }

    public function destroy(Comment $comment):RedirectResponse{
        if($comment->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }else{
            $comment->delete();
        }

        return back()->with('message', 'Comment deleted');
    }
}
