<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private PlanRepositoryInterface $planRepository;

    public function __construct(PlanRepositoryInterface $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function showAll()
    {
        return $this->planRepository->getAllPlans();
    }

    public function userPlan()
    {
        return $this->planRepository->getUserPlan();
    }

    public function show($id)
    {
        return $this->planRepository->getPlanById($id);
    }

    public function subscribe(Request $request)
    {
        return $this->planRepository->subscription($request);
    }

    public function cancel()
    {
        return $this->planRepository->cancel();
    }
}
