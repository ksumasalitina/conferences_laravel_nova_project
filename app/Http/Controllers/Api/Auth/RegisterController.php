<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @param UserRepositoryInterface $userRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request, UserRepositoryInterface $userRepository)
    {
        $user = $userRepository->createUser($request);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'role'=> $user->role
        ]);
    }
}
