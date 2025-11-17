<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3, 6),
            'description' => fake()->paragraphs(2, true),
            'project_id' => \App\Models\Project::inRandomOrder()->first()?->id,
            'is_completed' => fake()->boolean(30),
            'due_date' => fake()->dateTimeBetween('now', '+6 months'),
            'created_at' => fake()->dateTimeBetween('-1 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
