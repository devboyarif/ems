<?php

namespace Database\Factories;

use App\Models\EmailGroup;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $email_group_id = EmailGroup::inRandomOrder()->value('id');
        $subjects = [
            'Welcome to our platform',
            'We miss you',
            'Check out our new products',
            'We have a special offer for you',
            'We have a new feature',
        ];

        return [
            'email_group_id' => Arr::random([$email_group_id, null]),
            'email' => fake()->email,
            'subject' => Arr::random($subjects),
            'message' => fake()->paragraph,
            'status' => fake()->randomElement(['pending', 'sent', 'failed']),
        ];
    }
}
