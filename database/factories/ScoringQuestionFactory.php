<?php

namespace Database\Factories;

use App\Models\ScoringQuestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class ScoringQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => ScoringQuestion::QUESTION_TOGGLE,
            'question' => fake()->sentence(),
            'points' => fake()->numberBetween(1, 10),
            'sort' => 0,
        ];
    }
}
