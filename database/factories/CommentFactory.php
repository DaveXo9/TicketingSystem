<?php

namespace Database\Factories;
use App\Models\User;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tickets = Ticket::pluck('id');
        $users = User::pluck('id');

        return [
            'ticket_id' => $this->faker->randomElement($tickets),
            'user_id' => $this->faker->randomElement($users),
            'comment' => $this->faker->paragraph(4),
        ];
    }
}
