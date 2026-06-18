<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class LikeTest extends TestCase
{
    public function test_guest_cannot_like_item(): void
    {
        $item = Item::first();

        $response = $this->post('/like/' . $item->id);

        $response->assertRedirect('/login');
    }

    public function test_login_user_can_like_item(): void
    {
        $user = User::first();
        $user->email_verified_at = now();
        $user->save();

        $item = Item::first();

        Like::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->delete();

        $response = $this->actingAs($user)->post('/like/' . $item->id);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_login_user_can_unlike_item(): void
    {
        $user = User::first();
        $user->email_verified_at = now();
        $user->save();

        $item = Item::first();

        Like::firstOrCreate([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->post('/like/' . $item->id);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}