<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'meeting_id' => 1,
            'slot_id' => 1,
            'theme' => fake()->name(),
            'description' => fake()->sentence(),
            'presentation' =>  \Illuminate\Http\UploadedFile::fake()->create('test.pptx')
        ];
    }
}
