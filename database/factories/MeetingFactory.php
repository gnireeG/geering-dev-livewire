<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $from = $this->faker->dateTimeBetween('-1 month', '+3 month');
        
        // Set the time to a random business hour between 08:00 and 15:00
        $businessHours = [8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5, 13, 13.5, 14, 14.5, 15];
        $selectedTime = $this->faker->randomElement($businessHours);
        $hour = floor($selectedTime);
        $minute = ($selectedTime - $hour) * 60; // 0 for .0, 30 for .5
        $from->setTime($hour, $minute, 0);
        
        // Generate duration in 30-minute increments (1-6 increments = 30min to 3hours)
        $durationIncrements = $this->faker->numberBetween(1, 6);
        $to = (clone $from)->add(new \DateInterval('PT' . ($durationIncrements * 30) . 'M')); 

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'location' => $this->faker->url,
            'from' => $from,
            'to' => $to,
            'company_id' => \App\Models\Company::inRandomOrder()->first()->id,
        ];
    }
}
