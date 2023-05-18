<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function create(array $clientFields)
    {
        $client = Client::where('email', $clientFields['email'])->first();

        if ($client) {
            return $client;
        } else {
            $client = Client::create($clientFields);
            return $client;
        }
    }
}
