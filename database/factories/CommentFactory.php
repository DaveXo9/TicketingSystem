<?php

namespace Database\Factories;
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
        return [
            'comment' => $this->faker->paragraph(4),
            'ticket_id' => $this->faker->randomElement($tickets),
        ];
    }
}
