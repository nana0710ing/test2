<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();

    return view('sell.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'image' => 'required|image',
        'category_ids' => 'required',
        'condition_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ], [
        'image.required' => '商品画像を選択してください',
        'image.image' => '商品画像は画像ファイルを選択してください',
        'category_ids.required' => 'カテゴリーを選択してください',
        'condition_id.required' => '商品の状態を選択してください',
        'name.required' => '商品名を入力してください',
        'description.required' => '商品の説明を入力してください',
        'price.required' => '販売価格を入力してください',
        'price.numeric' => '販売価格は数字で入力してください',

    ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $item = Item::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'brand_name' => $request->brand_name,
        'condition_id' => $request->condition_id,
        'category_id' => $request->category_ids[0],
        'img_url' => 'storage/' . $imagePath,
        'user_id' => auth()->id(),
    ]);

    $item->categories()->attach($request->category_ids);

    return redirect('/');
    }
}