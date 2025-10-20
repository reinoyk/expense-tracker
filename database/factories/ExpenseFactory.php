<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => fake()->sentence(3),
            'amount' => fake()->numberBetween(15000, 300000),
            'date' => fake()->dateTimeBetween('-1 month', 'now'),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
