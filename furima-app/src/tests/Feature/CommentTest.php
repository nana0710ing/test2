<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_items_page_can_be_displayed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_post_comment(): void
    {
        $item = $this->createItem();

        $response = $this->post('/comment/' . $item->id, [
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_comment_is_required(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = $this->createItem();

        $response = $this->actingAs($user)->post('/comment/' . $item->id, [
            'comment' => '',
        ]);

        $response->assertSessionHasErrors('comment');
    }

    public function test_comment_must_be_255_characters_or_less(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = $this->createItem();

        $response = $this->actingAs($user)->post('/comment/' . $item->id, [
            'comment' => str_repeat('あ', 256),
        ]);

        $response->assertSessionHasErrors('comment');
    }

    public function test_login_user_can_post_comment(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = $this->createItem();

        $response = $this->actingAs($user)->post('/comment/' . $item->id, [
            'comment' => 'テストコメント',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);
    }

    private function createItem()
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

        return Item::create([
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'category_id' => 1,
            'img_url' => 'test.jpg',
            'user_id' => $user->id,
        ]);
    }
}
