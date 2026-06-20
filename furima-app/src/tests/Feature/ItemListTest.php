<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ItemListTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_items_are_displayed()
    {
        $user = User::factory()->create();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'カテゴリ1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'カテゴリ2', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('conditions')->insert([
            ['id' => 1, 'name' => '良好', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('items')->insert([
            [
                'user_id' => $user->id,
                'name' => 'テスト商品1',
                'price' => 1000,
                'description' => 'テスト説明1',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'test1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'name' => 'テスト商品2',
                'price' => 2000,
                'description' => 'テスト説明2',
                'condition_id' => 1,
                'category_id' => 2,
                'img_url' => 'test2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('テスト商品1');
        $response->assertSee('テスト商品2');
    }

    public function test_sold_label_is_displayed_for_purchased_item()
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
            'name' => '購入済み商品',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('purchases')->insert([
            'user_id' => $user->id,
            'item_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_own_items_are_not_displayed()
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
                'user_id' => $user->id,
                'name' => '自分の商品',
                'price' => 1000,
                'description' => 'テスト説明',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'own.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $otherUser->id,
                'name' => '他人の商品',
                'price' => 2000,
                'description' => 'テスト説明',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'other.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('自分の商品');
        $response->assertSee('他人の商品');
    }
}