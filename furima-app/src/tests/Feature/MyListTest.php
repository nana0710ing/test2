<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MyListTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_liked_items_are_displayed()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'カテゴリ1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('conditions')->insert([
            ['id' => 1, 'name' => '良好', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('items')->insert([
            [
                'id' => 1,
                'user_id' => $otherUser->id,
                'name' => 'いいねした商品',
                'price' => 1000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'test1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => $otherUser->id,
                'name' => 'いいねしていない商品',
                'price' => 2000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'test2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('likes')->insert([
            'user_id' => $user->id,
            'item_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/mylist');

        $response->assertStatus(200);
        $response->assertSee('いいねした商品');
        $response->assertDontSee('いいねしていない商品');
    }

    public function test_sold_label_is_displayed_on_mylist_for_purchased_item()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'カテゴリ1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('conditions')->insert([
            ['id' => 1, 'name' => '良好', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('items')->insert([
            'id' => 1,
            'user_id' => $otherUser->id,
            'name' => '購入済み商品',
            'price' => 1000,
            'description' => 'テスト',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('likes')->insert([
            'user_id' => $user->id,
            'item_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('purchases')->insert([
            'user_id' => $user->id,
            'item_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/mylist');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_nothing_is_displayed_on_mylist_when_not_authenticated()
    {
        $user = User::factory()->create();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'カテゴリ1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('conditions')->insert([
            ['id' => 1, 'name' => '良好', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('items')->insert([
            'id' => 1,
            'user_id' => $user->id,
            'name' => '未認証では見えない商品',
            'price' => 1000,
            'description' => 'テスト',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get('/mylist');

        $response->assertStatus(200);
        $response->assertDontSee('未認証では見えない商品');
    }
}