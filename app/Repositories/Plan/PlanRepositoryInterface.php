<?php

namespace App\Repositories\Plan;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface PlanRepositoryInterface
{
    public function getAllPlans(): Collection;
    public function getUserPlan(): Plan;
    public function getPlanById($id): Plan;
    public function subscription(Request $request);
    public function cancel(): void;
}
