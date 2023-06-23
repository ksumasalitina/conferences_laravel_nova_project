<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => 1,
            'title' => fake()->name,
            'date' => fake()->dateTime,
            'country' => 'Ukraine',
            'latitude'=> fake()->latitude,
            'longitude' => fake()->longitude
        ];
    }
}
