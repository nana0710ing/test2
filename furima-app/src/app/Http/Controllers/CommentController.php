<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $item)
    {
        Comment::create([
            'user_id' => auth()->user()->id,
            'item_id' => $item,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
