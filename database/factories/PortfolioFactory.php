<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PortfolioFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mdfaker = \Faker\Factory::create();
        $mdfaker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($mdfaker));
        return [
            'title' => fake()->sentence(3),
            'description' => $mdfaker->markdown(),
            'shortdesc' => fake()->sentence(Rand(7, 15)),
        ];
    }

}
