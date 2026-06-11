<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->user_id === auth()->id()) {
            return redirect('/');
        }

        $user = auth()->user();

        return view('purchase', compact('item', 'user'));
    }

    public function store($item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->user_id === auth()->id()) {
            return redirect('/');
        }
        request()->validate([
            'payment_method' => 'required',
        ], [
            'payment_method.required' => '支払い方法を選択してください',
        ]);

        Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
        ]);
        return redirect('/');
    }
}
