<?php

namespace App\Policies;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MeetingPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Meeting $meeting)
    {
        return Auth::check();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Meeting $meeting)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Meeting $meeting)
    {
        return $user->isAdmin();
    }
}
