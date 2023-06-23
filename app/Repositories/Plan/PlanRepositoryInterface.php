<?php

namespace App\Repositories\Plan;

use Illuminate\Http\Request;

interface PlanRepositoryInterface
{
    public function getAllPlans();
    public function getUserPlan();
    public function getPlanById($id);
    public function subscription(Request $request);
    public function cancel();
}
