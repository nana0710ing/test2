<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    public function test_user_can_logout(): void
    {
        $user = User::first();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();
    }
}