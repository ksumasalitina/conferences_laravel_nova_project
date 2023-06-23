<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\UserTrait;

class RegisterTest extends TestCase
{
    use UserTrait;

    public function test_user_register_successfully()
    {
        $user = self::newUser();

        $response = $this->postJson(self::URL_REGISTER, $user);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => 'email@gmail.com',
        ]);
        $response->assertJsonStructure(self::structureApiAuth());
    }

    public function test_user_register_invalid()
    {
        $user = self::newInvalidUser();

        $response = $this->postJson(self::URL_REGISTER, $user);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['first_name','last_name']);
    }

    public function test_user_email_already_exists()
    {
        $user = self::newUser();

        $this->postJson(self::URL_REGISTER, $user);
        $response = $this->postJson(self::URL_REGISTER, $user);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
