<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($item_id)
    {
        $like = Like::where('user_id', 1)
            ->where('item_id', $item_id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => 1,
                'item_id' => $item_id,
            ]);
        }
        return back();
    }
}