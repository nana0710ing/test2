<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $data = [
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $user->update($data);

    return redirect('/mypage');
    }
}