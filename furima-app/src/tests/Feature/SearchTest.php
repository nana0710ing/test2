<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_can_be_searched_by_partial_match()
    {
        $user = User::factory()->create();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'カテゴリ1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('conditions')->insert([
            ['id' => 1, 'name' => '良好', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('items')->insert([
            [
                'user_id' => $user->id,
                'name' => '腕時計',
                'price' => 1000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'watch.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'name' => '財布',
                'price' => 2000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'wallet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $response = $this->get('/?keyword=腕');

        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertDontSee('財布');
    }

    public function test_search_keyword_is_kept_in_mylist()
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
                'name' => '腕時計',
                'price' => 1000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'watch.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => $otherUser->id,
                'name' => '財布',
                'price' => 2000,
                'description' => 'テスト',
                'condition_id' => 1,
                'category_id' => 1,
                'img_url' => 'wallet.jpg',
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

        $response = $this->actingAs($user)
            ->get('/mylist?keyword=腕');

        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertDontSee('財布');
    }
}
