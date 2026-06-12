<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;
use Stripe\Stripe;

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

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                    'name' => $item->name,
                ],
                'unit_amount' => $item->price,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => url('/purchase/success/' . $item_id),
        'cancel_url' => url('/purchase/' . $item_id),
    ]);

    return redirect($checkout_session->url);
}

public function success($item_id)
{
    Purchase::firstOrCreate([
        'user_id' => auth()->id(),
        'item_id' => $item_id,
    ]);

    return redirect('/');
}
}
