<?php

namespace Database\Factories;
use App\Models\User;


use App\Models\Client;
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
        $users = User::pluck('id');
        $clients = Client::pluck('id');

        return [
            'user_id' => $this->faker->randomElement($users),
            'client_id' => $this->faker->randomElement($clients),
            'status_id' => $this->faker->randomElement($statuses),
            'title'=> $this->faker->sentence(),
            'description'=> $this->faker->paragraph(4),
            'priority'=> $this->faker->randomElement(['Low', 'Medium', 'High']),

        ];
    }
}
