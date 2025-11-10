<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $status = fake()->randomElement(['draft', 'sent', 'failed']);
        $reply_status = $status === 'sent' ? fake()->randomElement(['no_reply', 'replied']) : 'no_reply';
        
        return [
            'subject' => fake()->sentence(4, 8),
            'recipients' => fake()->email(),
            'cc' => fake()->email(),
            'bcc' => fake()->email(),
            'body' => $this->generateHtmlContent(),
            'body_text' => fake()->text(),
            'sent_at' => now(),
            'status' => $status,
            'reply_status' => $reply_status,
            'created_at' => fake()->dateTimeBetween('-1 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 years', 'now'),
        ];
    }

    /**
     * Generate fake HTML content
     */
    private function generateHtmlContent(): string
    {
        $content = '<h1>' . fake()->sentence(3) . '</h1>';
        $content .= '<p>' . fake()->paragraph() . '</p>';
        $content .= '<h2>' . fake()->sentence(2) . '</h2>';
        $content .= '<p>' . fake()->paragraph() . '</p>';
        $content .= '<ul>';
        $content .= '<li>' . fake()->sentence() . '</li>';
        $content .= '<li>' . fake()->sentence() . '</li>';
        $content .= '<li>' . fake()->sentence() . '</li>';
        $content .= '</ul>';
        $content .= '<p><strong>' . fake()->word() . ':</strong> ' . fake()->sentence() . '</p>';
        $content .= '<p>' . fake()->paragraph() . '</p>';
        
        return $content;
    }

}
