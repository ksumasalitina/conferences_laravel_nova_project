<?php

namespace App\Repositories\Plan;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PlanRepository implements PlanRepositoryInterface
{
    public function getAllPlans(): Collection
    {
        return Plan::all();
    }

    public function getUserPlan(): Plan
    {
        /** @var User $user */
        $user = User::findOrFail(auth('sanctum')->id());

        $joins = match ($user->plan_id) {
            1 => 1 - $user->monthly_joins,
            2 => 5 - $user->monthly_joins,
            3 => 50 - $user->monthly_joins,
            default => 'Unlimited'
        };

        /** @var Plan $plan */
        $plan = Plan::query()->findOrFail($user->plan_id);
        $plan->setAttribute('joins', $joins);

        return $plan;
    }

    public function getPlanById($id): Plan
    {
        /** @var Plan $plan */
        $plan = Plan::query()->findOrFail($id);
        $plan->setAttribute('intent', auth('sanctum')->user()->createSetupIntent());

        return $plan;
    }

    public function subscription(Request $request)
    {
        /** @var User $user */
        $user = User::query()->findOrFail(auth('sanctum')->id());

        /** @var User $plan */
        $plan = Plan::query()->findOrfail($request->plan);
        $user->subscription($user->plan_id)->cancelNow();

        $user->update(['plan_id'=>$request->plan]);

        return $user->newSubscription($request->plan, $plan->stripe_plan)
            ->create($request->token);
    }

    public function cancel(): void
    {
        /** @var User $user */
        $user = User::query()->findOrFail(auth('sanctum')->id());

        $user->subscription($user->plan_id)->cancelNow();
        $user->update(['plan_id'=>1]);
        $user->newSubscription(1, 'price_1MOjmPEnpsfQaHkImwfrBRKv')->create();
    }
}
