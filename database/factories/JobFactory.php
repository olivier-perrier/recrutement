<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->realText(),
            'contract_type' => collect(['CDI', 'CDD', 'Interim'])->random(),
            'salary' => fake()->numberBetween(1000, 5000),
            'address_id' => Address::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
