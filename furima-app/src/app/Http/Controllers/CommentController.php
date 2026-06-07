<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $item)
    {
        $request->validate([
            'comment' => 'required|max:255',
            ], [
                'comment.required' => 'コメントを入力してください',
                'comment.max' => 'コメントは255文字以内で入力してください',
            ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'item_id' => $item,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
