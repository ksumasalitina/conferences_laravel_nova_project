<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\UserTrait;

class ProfileUpdateTest extends TestCase
{
    use UserTrait;

    public function test_profile_updated_successfully()
    {
        $user = self::fakeListener();
        $newUser = self::newUser();
        $newUser['email'] = 'email123@gmail.com';

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_PROFILE, $newUser);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageUpdateProfile());
        $this->assertDatabaseHas('users', self::structureDatabaseAfterUpdate());
    }

    public function test_unauthorized_user_cannot_update_profile()
    {
        $user = self::fakeListener();
        $newUser = self::newUser();
        $newUser['email'] = 'email123@gmail.com';

        $response = $this->putJson(self::URL_UPDATE_PROFILE, $newUser);

        $response->assertStatus(401);
        $this->assertDatabaseMissing('users', self::structureDatabaseAfterUpdate());
    }
}
