<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\UserTrait;

class LogoutTest extends TestCase
{
    use UserTrait;

    public function test_user_logout_successfully()
    {
        $user = self::fakeListener();

        $response = $this->actingAs($user)->postJson(self::URL_LOGOUT);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'User logged out'
        ]);
    }
}
