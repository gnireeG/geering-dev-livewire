<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3, 5),
            'description' => fake()->paragraphs(3, true),
            'company_id' => \App\Models\Company::inRandomOrder()->first()?->id,
            'status' => fake()->randomElement(\App\Enums\ProjectStatus::values()),
            'start_date' => fake()->dateTimeBetween('-1 years', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+1 years'),
        ];
    }
}
