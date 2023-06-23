<?php

namespace Tests\Traits\GenerateData;

use App\Models\User;
use Stripe\PaymentMethod;

trait UserTrait
{
    protected static function fakeAnnouncer()
    {
        $user = User::factory()->create();
        $user->role()->attach(2);
        return $user;
    }

    protected static function fakeListener()
    {
        $user = User::factory()->create();
        $user->role()->attach(1);
        return $user;
    }

    protected static function fakeAdmin()
    {
        $user = User::factory()->create();
        $user->role()->attach(3);
        return $user;
    }

    protected static function newUser(): array
    {
        return [
            'first_name' => 'First',
            'last_name' => 'Last',
            'email'=>'email@gmail.com',
            'password'=>'12345678',
            'password_confirmation'=>'12345678',
            'birthdate'=>'2002-01-01',
            'country'=>'USA',
            'phone'=>'+1 (555) 555-5555',
            'role'=>1
        ];
    }

    protected static function newInvalidUser(): array
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'email'=>'email@gmail.com',
            'password'=>'12345678',
            'password_confirmation'=>'12345678',
            'birthdate'=>'2002-01-01',
            'country'=>'USA',
            'phone'=>'+1 (555) 555-5555',
            'role'=>1
        ];
    }

    protected static function structureApiAuth(): array
    {
        return [
            'access_token',
            'token_type',
            'user',
            'role'
        ];
    }

    protected static function successMessageUpdateProfile(): array
    {
        return [
            'message' => 'Profile updated'
        ];
    }

    protected static function structureDatabaseAfterUpdate(): array
    {
        return [
            'id' => 1,
            'email' => 'email123@gmail.com'
        ];
    }
}
