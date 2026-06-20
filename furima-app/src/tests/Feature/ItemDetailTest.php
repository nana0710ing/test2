<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_name_is_displayed()
    {
        $user = User::factory()->create();

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
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_item')->insert([
            'item_id' => 1,
            'category_id' => 1,
        ]);

        DB::table('comments')->insert([
            'user_id' => $user->id,
            'item_id' => 1,
            'comment' => 'テストコメント',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $item = DB::table('items')->first();

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
        $response->assertSee('¥1,000');
        $response->assertSee('テスト説明');
        $response->assertSee('良好');
        $response->assertSee('カテゴリ1');
        $response->assertSee('テストブランド');
        $response->assertSee('test.jpg');
        $response->assertSee('0');
        $response->assertSee('テストコメント');
        $response->assertSee($user->name);
    }

}
