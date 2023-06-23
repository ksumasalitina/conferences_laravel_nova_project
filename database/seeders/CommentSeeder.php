<?php

namespace Database\Seeders;

use App\Models\Lecture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $lectures = Lecture::all();

        foreach ($lectures as $lecture){
            for($i=1;$i<8;$i++) {
                DB::table('comments')->insert([
                    'user_id' => rand(1, 5),
                    'lecture_id'=>$lecture->id,
                    'comment'=>$faker->sentence
                ]);
            }
        }
    }
}
