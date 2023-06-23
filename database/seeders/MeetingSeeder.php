<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=1;$i<=15;$i++){
            DB::table('meetings')->insert([
                    'title'=>$faker->name,
                    'date'=>$faker->dateTime,
                    'country'=>$faker->country,
                    'latitude'=>$faker->latitude,
                    'longitude'=>$faker->longitude
            ]);

            $meeting = Meeting::findOrFail($i);
            for($j=1;$j<=10;$j++) {
                $meeting->slots()->attach($j);
            }
        }
    }
}
