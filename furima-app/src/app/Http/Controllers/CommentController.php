<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $item_id)
    {
        $request->validate(
            [
                'comment' => 'required',
            ],
            [
                'comment.required' => 'コメントを入力してください',
            ]
        );
        Comment::create([
            'user_id' => 1,
            'item_id' => $item_id,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
