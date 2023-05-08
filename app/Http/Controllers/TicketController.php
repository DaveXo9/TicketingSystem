<?php

namespace App\Http\Controllers;
use App\Models\Status;
use App\Models\Ticket;


use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
    }
    public function show(Ticket $ticket){
        return view('ticket.show', compact('ticket'));
    }

    public function openTickets(){
        $tickets = Ticket::where('status_id', 1)->latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
    }
    // Show single ticket
    public function show(Ticket $ticket){
        return view('ticket.show', compact('ticket'));
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

        $clientController = new ClientController();
        $client = $clientController->create($clientFields);

        $ticketFields = $request->validate([
            'title' => ['required','min:3',],
            'description'=> ['required', 'string'],
            'priority' => 'required|string',
        ]);

        $status_id = Status::where('status', $request->status)->first()->id;

        $ticketFields['user_id'] = auth()->id();
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

        $request->validate([
            'email' => 'required|email',
            'status' => 'required|string',
        ]);

        $status_id = Status::where('status', $request->status)->first()->id;

        $user_id = User::where('email', $request->email)->first()->id;

        if (!$user_id) {
            return back()->withErrors(['email' => 'The provided email is not associated with any user']);
        }

        if ($ticket->user_id != $user_id) {
            $formFields['user_id'] = $user_id;
        }
        if ($ticket->status_id != $status_id) {
            $formFields['status_id'] = $status_id;
        }

        $ticket->update($formFields);

        return back()->with('message', 'Ticket updated');

        
    }

    public function destroy(Ticket $ticket){
        $ticket->delete();

        return redirect('/')->with('message', 'Ticket deleted');
    
    }
    
}
