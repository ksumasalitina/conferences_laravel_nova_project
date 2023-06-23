<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Stripe\Stripe;
use Tests\TestCase;
use Tests\Traits\GenerateData\SubscriptionTrait;
use Tests\Traits\GenerateData\UserTrait;

class SubscriptionTest extends TestCase
{
    use UserTrait, SubscriptionTrait;

    public function test_user_subscribe_successfully()
    {
        $user = self::fakeListener();
        Stripe::setApiKey(env('STRIPE_KEY'));
        $request = self::newSubscription();

        $response = $this->actingAs($user)->postJson(self::URL_SUBSCRIBE, $request);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', self::structureDatabaseUsersHasPlan());
        $this->assertDatabaseHas('subscriptions', self::structureDatabaseSubcriptionsHasPlan());
    }

    public function test_unauthenticated_user_cannot_subscribe()
    {
        Stripe::setApiKey(env('STRIPE_KEY'));
        $request = self::newSubscription();

        $response = $this->postJson(self::URL_SUBSCRIBE, $request);

        $response->assertStatus(401);
    }

    public function test_subscription_plan_does_not_exists()
    {
        $user = self::fakeListener();
        Stripe::setApiKey(env('STRIPE_KEY'));
        $request = self::newInvalidSubscription();

        $response = $this->actingAs($user)->postJson(self::URL_SUBSCRIBE, $request);

        $response->assertStatus(404);
        $this->assertDatabaseMissing('users', self::structureDatabaseUsersMissingPlan());
        $this->assertDatabaseMissing('subscriptions', self::structureDatabaseSubcriptionsMissingPlan());
    }
}
