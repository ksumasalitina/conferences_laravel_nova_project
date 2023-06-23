<?php

namespace App\Repositories\User;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(RegisterRequest $request)
    {
        $request['birthdate'] = date('Y/m/d', strtotime($request['birthdate']));

        return User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'birthdate'=>$request['birthdate'],
            'country'=>$request['country'],
            'phone'=>$request['phone'],
            'plan_id'=>1
        ]);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function updateProfile(UpdateRequest $request, $id)
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'birthdate',
            'country',
            'phone'
        ]);

        if($request['email'] != null){
            $data['email'] = $request['email'];
        }

        if($request['password'] != null){
            $data['password'] = Hash::make($request['password']);
        }

        return User::query()->where('id', $id)->update($data);
    }
}
