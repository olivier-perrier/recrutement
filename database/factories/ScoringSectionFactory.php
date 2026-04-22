<?php

namespace Database\Factories;

use App\Models\ScoringQuiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class ScoringSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'scoring_quiz_id' => ScoringQuiz::factory(),
            'sort' => 0,
        ];
    }
}
