<?php

namespace App\Http\Controllers;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;

use App\Services\ClientService;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\UserRequest;

use App\Notifications\TicketAssigned;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function __construct(private ClientService $clientService)
    {
    }

    public function index(){
        $tickets = Ticket::latest()->filter(request(['search']))->paginate(10);
        return view('ticket.index', compact('tickets'));
    }
    public function show(Ticket $ticket){
        return view('ticket.show', compact('ticket'));
    }

    public function openTickets(){
        $tickets = Ticket::where('status_id', 1)->latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
    }


    public function create(){
        return view('ticket.create');
    }

    public function store(ClientRequest $clientRequest, TicketRequest $ticketRequest){
        $clientFields = $clientRequest->validated();

        $client = $this->clientService->create($clientFields);

        $ticketFields = $ticketRequest->safe()->except(['status']);

        $status_id = Status::where('status', $ticketRequest->safe()->only(['status']))->first()->id;

        $ticketFields['user_id'] = auth()->id();
        $ticketFields['client_id'] = $client->id;
        $ticketFields['status_id'] = $status_id;

        Ticket::create($ticketFields);

        return redirect('/')->with('message', 'Ticket created');

    }

    public function edit(Ticket $ticket){
        return view('ticket.edit', compact('ticket'));
    }

    public function update(TicketRequest $ticketRequest, UserRequest $userRequest, Ticket $ticket){
        $formFields = $ticketRequest->safe()->except(['status']);

        $status_id = Status::where('status', $ticketRequest->safe()->only(['status']))->first()->id;

        $user = User::where('email', $userRequest->safe()->only(['email']))->first();

        if (!$user->id) {
            return back()->withErrors(['email' => 'The provided email is not associated with any user']);
        }

        if ($ticket->user_id != $user->id) {
            $formFields['user_id'] = $user->id;
        }
        if ($ticket->status_id != $status_id) {
            $formFields['status_id'] = $status_id;
        }

        $ticket->update($formFields);
        $user->notify(new TicketAssigned($ticket));

        return redirect('/')->with('message', 'Ticket updated');

        
    }

    public function destroy(Ticket $ticket){
        $ticket->delete();

        return redirect('/')->with('message', 'Ticket deleted');
    
    }
    
}
