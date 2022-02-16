<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 999999), // 6 figures allowed
            'description' => $this->faker->realText,
        ];
    }
}
