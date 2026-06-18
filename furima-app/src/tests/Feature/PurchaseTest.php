<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class PurchaseTest extends TestCase
{
    public function test_login_user_can_purchase_item(): void
    {
        $user = User::first();

        $user->email_verified_at = now();
        $user->postal_code = '123-4567';
        $user->address = '東京都渋谷区';
        $user->save();

        $item = Item::first();

        $response = $this->actingAs($user)
            ->get('/purchase/success/' . $item->id);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}
