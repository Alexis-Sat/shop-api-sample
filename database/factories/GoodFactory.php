<?php

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->domainWord,
            'count' => rand(1, 200),
            'price' => rand(10,1000),

        ];
    }
}
