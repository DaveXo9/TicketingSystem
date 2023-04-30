<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Status;


use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
    }

    public function openTickets(){
        $tickets = Ticket::where('status_id', 1)->latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
    }

    public function create(){
        return view('ticket.create');
    }

    public function store(Request $request){
        $clientFields = $request->validate([
            'name' => ['required','min:3',],
            'email'=> ['required', 'email', Rule::unique('clients', 'email')],
            'phone_number' => 'required|string',
        ]);

        $client = ClientController::create($clientFields);

        $ticketFields = $request->validate([
            'title' => ['required','min:3',],
            'description'=> ['required', 'string'],
            'priority' => 'required|string',
        ]);

        $status_id = Status::where('status', $request->status)->first()->id;

        $ticketFields['user_id'] = auth()->id;
        $ticketFields['client_id'] = $client->id;
        $ticketFields['status_id'] = $status_id;

        Ticket::create($ticketFields);

        return redirect('/')->with('message', 'Ticket created');

    }

    public function edit(Ticket $ticket){
        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket){
        $formFields = $request->validate([
            'title' => ['required','min:3',],
            'description'=> ['required', 'string'],
            'priority' => 'required|string',
        ]);

        $status_id = Status::where('status', $request->status)->first()->id;

        $user_id = User::where('email', $request->email)->first()->id;

        if ($ticket->user_id != $user->id) {
            $formFields['user_id'] = $user_id;
        }
        if ($ticket->status_id != $request->input('status_id')) {
            $formFields['status_id'] = $status_id;
        }

        $ticket->update($formFields);

        return redirect('/')->with('message', 'Ticket updated');

        
    }

    public function destroy(Ticket $ticket){
        $ticket->delete();

        return redirect('/')->with('message', 'Ticket deleted');
    
    }
    
}
