<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\User;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = User::find(1);

        return view('purchase', compact('item', 'user'));
    }

    public function store($item_id)
    {
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
