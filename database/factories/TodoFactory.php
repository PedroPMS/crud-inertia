<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'is_done' => $this->faker->boolean()
        ];
    }
}
