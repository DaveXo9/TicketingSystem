<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index(){
        $clients = Client::latest();
        return view('client.index', compact('clients'));
    }

    public function create(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required','min:3',],
            'email'=> ['required', 'email', Rule::unique('clients', 'email')],
            'phone_number' => 'required|string|max:255',
        ]);

        $client = Client::where('email', $validatedData['email'])->first();

        if($client){
            return $client;
        }
        else{
            $client = Client::create($validatedData);
            return $client;
        }
    }
    public function edit(Client $client){
        return view('client.edit');
    }

    public function update(Request $request, Clinet $client){
        $formFields = $request->validate([
            'name' => ['required','min:3',],
            'email'=> ['required', 'email', Rule::unique('clients', 'email')->ignore($client->id)],
        ]);

        $user->update($formFields);

        return redirect('/')->with('message', 'Client updated');
    }

    public function destroy(Client $client){
        $client->delete();

        return redirect('/')->with('message', 'Client deleted');
    
    }
}
