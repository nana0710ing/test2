<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;


class PurchaseController extends Controller
{
    public function store($item_id)
    {
        Purchase::create([
            'user_id' => 1,
            'item_id' => $item_id,
        ]);
        return redirect('/');
    }
}
