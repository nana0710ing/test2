<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    private function createItem()
    {
        $seller = User::factory()->create();

        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'カテゴリ1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conditions')->insert([
            'id' => 1,
            'name' => '良好',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('items')->insert([
            'id' => 1,
            'user_id' => $seller->id,
            'name' => 'テスト商品',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::table('items')->first();
    }

    public function test_guest_cannot_like_item(): void
    {
        $item = $this->createItem();

        $response = $this->post('/like/' . $item->id);

        $response->assertRedirect('/login');
    }

    public function test_login_user_can_like_item(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = $this->createItem();

        DB::table('likes')->where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->delete();

        $this->actingAs($user)->post('/like/' . $item->id);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_login_user_can_unlike_item(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = $this->createItem();

        DB::table('likes')->insert([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($user)->post('/like/' . $item->id);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}