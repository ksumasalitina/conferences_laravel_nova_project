<?php

namespace App\Repositories\Plan;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class PlanRepository implements PlanRepositoryInterface
{
    public function getAllPlans()
    {
        return Plan::all();
    }

    public function getUserPlan()
    {
        $user = User::findOrFail(auth('sanctum')->id());
        $joins = 0;

        if($user->plan_id == 1) $joins = 1 - $user->monthly_joins;
        elseif ($user->plan_id == 2) $joins = 5 - $user->monthly_joins;
        elseif ($user->plan_id == 3) $joins = 50 - $user->monthly_joins;
        else $joins = 'Unlimited';

        $plan = Plan::query()->findOrFail($user->plan_id);
        $plan->joins = $joins;
        return $plan;
    }

    public function getPlanById($id)
    {
        $plan = Plan::query()->findOrFail($id);
        $plan->intent = auth('sanctum')->user()->createSetupIntent();
        return $plan;
    }

    public function subscription(Request $request)
    {
        $user = User::query()->findOrFail(auth('sanctum')->id());
        $plan = Plan::query()->findOrfail($request->plan);
        $user->subscription($user->plan_id)->cancelNow();
        User::query()->where('id',auth('sanctum')->id())->update(['plan_id'=>$request->plan]);

        return $user->newSubscription($request->plan, $plan->stripe_plan)
            ->create($request->token);
    }

    public function cancel()
    {
        $user = User::query()->findOrFail(auth('sanctum')->id());
        $user->subscription($user->plan_id)->cancelNow();
        User::query()->where('id',auth('sanctum')->id())->update(['plan_id'=>1]);
        $user->newSubscription(1, 'price_1MOjmPEnpsfQaHkImwfrBRKv')->create();
    }
}
