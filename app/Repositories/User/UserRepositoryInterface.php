<?php

namespace App\Repositories\User;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(RegisterRequest $request): User;
    public function getUserByEmail($email): User;
    public function updateProfile(UpdateRequest $request, $id): int;
}
