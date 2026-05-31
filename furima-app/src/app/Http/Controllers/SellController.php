<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();

    return view('sell.create', compact('categories'));
    }

    public function store(Request $request)
    {

    }
}