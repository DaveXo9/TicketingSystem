<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    
    public function index(){
        $clients = Client::latest()->paginate(10);
        return view('client.index', compact('clients'));
    }

    public function create(array $clientFields)
    {

        $client = Client::where('email', $clientFields['email'])->first();

        if($client){
            return $client;
        }
        else{
            $client = Client::create($clientFields);
            return $client;
        }
    }
    public function edit(Client $client){
        return view('client.edit', compact('client'));
    }

    public function update(Request $request, Client $client){
        $formFields = $request->validate([
            'name' => ['required','min:3',],
            'phone_number' => ['required'],
            'email'=> ['required', 'email', Rule::unique('clients', 'email')->ignore($client->id)],
        ]);

        $client->update($formFields);

        return redirect('/clients')->with('message', 'Client updated');
    }

    public function destroy(Client $client){
        $client->delete();

        return redirect('/clients')->with('message', 'Client deleted');
    
    }
}
