<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @param UserRepositoryInterface $userRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request, UserRepositoryInterface $userRepository)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = $userRepository->getUserByEmail($request['email']);

        if($user->isAdmin()){
            return response()->json([
                'role' => $user->role
            ]);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'role'=>$user->role
            ]);
        }
    }
}
