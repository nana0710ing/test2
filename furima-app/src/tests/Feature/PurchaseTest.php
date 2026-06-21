<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_user_can_purchase_item(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
        ]);

        $item = $this->createItem();

        $response = $this->actingAs($user)
            ->get('/purchase/success/' . $item->id);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_purchased_item_is_displayed_on_mypage(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
        ]);

        $item = $this->createItem();

        DB::table('purchases')->insert([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
    }

    public function test_purchased_item_is_displayed_as_sold(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
        ]);

        $item = $this->createItem();

        DB::table('purchases')->insert([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

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

        return Item::create([
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'user_id' => $seller->id,
        ]);
    }
}
