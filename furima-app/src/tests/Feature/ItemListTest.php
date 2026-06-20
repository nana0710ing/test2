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
}