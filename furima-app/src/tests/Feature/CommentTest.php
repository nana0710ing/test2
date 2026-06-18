<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Carbon;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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
        $item = Item::first();

        $response = $this->post('/comment/' . $item->id, [
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_comment_is_required(): void
    {
        $user = User::first();
        $user->email_verified_at = now();
        $user->save();

        $item = Item::first();

        $response = $this->actingAs($user)->post('/comment/' . $item->id, [
            'comment' => '',
        ]);

        $response->assertSessionHasErrors('comment');
    }
}
