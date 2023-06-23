<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\UserTrait;

class LoginTest extends TestCase
{
    use UserTrait;

    public function test_user_login_successfully()
    {
        $user = self::fakeListener();

        $response = $this->postJson(self::URL_LOGIN, ['email'=>$user->email, 'password'=>'12345678']);

        $response->assertStatus(200);
        $response->assertJsonStructure(self::structureApiAuth());
    }

    public function test_user_login_email_or_password_invalid()
    {
        $user = self::fakeListener();

        $response = $this->postJson(self::URL_LOGIN, ['email'=>$user->email, 'password'=>'1234567']);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid login details'
        ]);
    }

    public function test_login_user_is_admin()
    {
        $user = self::fakeAdmin();

        $response = $this->postJson(self::URL_LOGIN, ['email'=>$user->email, 'password'=>'12345678']);

        $response->assertStatus(200);
        $response->assertJson([ 'role'=>[] ]);
    }
}
