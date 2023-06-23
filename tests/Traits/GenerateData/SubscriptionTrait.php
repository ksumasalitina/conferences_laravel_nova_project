<?php

namespace Tests\Traits\GenerateData;

use Stripe\PaymentMethod;

trait SubscriptionTrait
{
    protected static function fakePaymentMethod()
    {
        return PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '2',
                'exp_year' => '2024',
                'cvc' => '314'
            ]
        ]);
    }

    protected static function newSubscription()
    {
        return [
            'plan' => 2,
            'token' => self::fakePaymentMethod()->id
        ];
    }

    protected static function newInvalidSubscription()
    {
        return [
            'plan' => 5,
            'token' => self::fakePaymentMethod()->id
        ];
    }

    protected static function structureDatabaseUsersHasPlan()
    {
        return [
            'id' => 1,
            'plan_id' => 2
        ];
    }

    protected static function structureDatabaseSubcriptionsHasPlan()
    {
        return [
            'user_id' => 1,
            'name' => 2,
            'stripe_status' => 'active'
        ];
    }

    protected static function structureDatabaseUsersMissingPlan()
    {
        return [
            'id' => 1,
            'plan_id' => 5
        ];
    }

    protected static function structureDatabaseSubcriptionsMissingPlan()
    {
        return [
            'user_id' => 1,
            'name' => 5,
            'stripe_status' => 'active'
        ];
    }
}
