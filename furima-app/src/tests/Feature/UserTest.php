<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_information_is_displayed_on_mypage(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email_verified_at' => now(),
            'image' => 'images/profile.jpg',
        ]);

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

        $sellItemId = DB::table('items')->insertGetId([
            'user_id' => $user->id,
            'name' => '出品商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $buyItemId = DB::table('items')->insertGetId([
            'user_id' => $seller->id,
            'name' => '購入商品',
            'brand_name' => 'テストブランド',
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
            'item_id' => $buyItemId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=sell');

        $response->assertStatus(200);
        $response->assertSee('テストユーザー');
        $response->assertSee('images/profile.jpg');
        $response->assertSee('出品商品');

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertStatus(200);
        $response->assertSee('購入商品');
    }

    public function test_profile_edit_page_displays_saved_user_information(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'image' => 'images/profile.jpg',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage/profile');

        $response->assertStatus(200);

        $response->assertSee('テストユーザー');
        $response->assertSee('123-4567');
        $response->assertSee('東京都渋谷区');
        $response->assertSee('images/profile.jpg');
    }
}