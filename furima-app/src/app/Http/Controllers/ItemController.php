<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;

class ItemController extends Controller
{
    public function index(Request $request)

    {
        $items = Item::where('name', 'like', '%' . $request->keyword . '%')->get();

        return view('items.index', compact('items'));
    }
    public function mylist(Request $request)
    {
        $likes = Like::where('user_id', 1)->pluck('item_id');

        $items = Item::whereIn('id', $likes)
            ->where('name', 'like', '%' . $request->keyword . '%')
            ->get();

        return view('items.index', compact('items'));

    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }
}
