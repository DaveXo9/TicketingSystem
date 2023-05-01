<?php

namespace Database\Factories;
use App\Models\Status;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = Status::pluck('id');

        return [
            'title'=> $this->faker->sentence(),
            'description'=> $this->faker->paragraph(4),
            'priority'=> $this->faker->randomElement(['Low', 'Medium', 'High']),
            'status_id' => $this->faker->randomElement($statuses),

        ];
    }
}
