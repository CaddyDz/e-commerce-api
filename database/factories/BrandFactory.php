<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;
        return [
            'uuid' => $this->faker->uuid,
            'title' => $title,
            'slug' => Str::of($title)->slug('-'),
        ];
    }
}
