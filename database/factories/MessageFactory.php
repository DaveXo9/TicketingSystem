<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id');

        return [
            'user_id' => $this->faker->randomElement($users),
            'recepient_id' => $this->faker->randomElement($users),
            'message' => $this->faker->paragraph(2),
        ];
    }
}
