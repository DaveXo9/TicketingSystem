<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Status;
use App\Models\Client;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        Client::factory(10)->create();

        Status::factory()->create([
            'status' => 'Open'
        ]);

        Status::factory()->create([
            'status' => 'In Progress'
        ]);

        Status::factory()->create([
            'status' => 'Closed'
        ]);

       Ticket::factory(10)->create();
       Comment::factory(20)->create();





    }
}
