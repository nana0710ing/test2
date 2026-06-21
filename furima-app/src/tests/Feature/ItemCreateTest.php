<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_item(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

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

        $response = $this->actingAs($user)->post('/sell', [
            'image' => UploadedFile::fake()->create('item.jpg', 100),
            'category_ids' => [1],
            'condition_id' => 1,
            'name' => 'テスト出品商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 3000,
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => 'テスト出品商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 3000,
            'condition_id' => 1,
            'category_id' => 1,
        ]);
    }
}