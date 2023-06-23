<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        /*DB::table('users')->insert(
            array([
            'id'=>1,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'admin_test@groupbwt.com',
            'password' => Hash::make('12345678'),
            'birthdate' => $faker->date,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber
            ],
            [
                'id'=>2,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => 'listener@groupbwt.com',
                'password' => Hash::make('12345678'),
                'birthdate' => $faker->date,
                'country' => $faker->country,
                'phone' => $faker->phoneNumber
            ],
            [
                'id'=>3,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => 'announcer@groupbwt.com',
                'password' => Hash::make('12345678'),
                'birthdate' => $faker->date,
                'country' => $faker->country,
                'phone' => $faker->phoneNumber
            ]));

        $admin = User::findOrFail(1);
        $admin->role()->attach(3);

        $listener = User::findOrFail(2);
        $listener->role()->attach(1);

        $announcer = User::findOrFail(3);
        $announcer->role()->attach(2);*/

        $users = User::query()->whereHas('role', function ($q) {
            $q->whereIn('role_id', [1,2]);
        })->get();

        foreach ($users as $user){
            User::query()->where('id',$user->id)->update(['plan_id'=>1]);
            $user->newSubscription(1, 'price_1MOjmPEnpsfQaHkImwfrBRKv')
                ->create();
        }
    }
}
