<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;

use App\Models\Ticket;

use Illuminate\Http\Request;
use App\Services\ClientService;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\UserRequest;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\TicketRequest;
use App\Notifications\TicketAssigned;

class TicketController extends Controller
{
    public function __construct(private ClientService $clientService)
    {
    }

    public function index():View {
        $tickets = Ticket::latest()->filter(request(['search']))->paginate(10);
        return view('ticket.index', compact('tickets'));

        // $tickets = Ticket::where('user_id', auth()->id())->latest()->filter(request(['search']))->paginate(10);
    }
    public function show(Ticket $ticket):View {
        return view('ticket.show', compact('ticket'));
    }

    public function openTickets():View {
        $tickets = Ticket::where('status_id', 1)->latest()->paginate(10);
        return view('ticket.index', compact('tickets'));
        // $tickets = Ticket::where('user_id', auth()->id())->where('status_id', 1)->latest()->paginate(10);

    }


    public function create():View{
        $clients = Client::all();
        return view('ticket.create', compact('clients'));
    }

    public function store(ClientRequest $clientRequest, TicketRequest $ticketRequest):RedirectResponse{
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

    public function edit(Ticket $ticket):View {
        return view('ticket.edit', compact('ticket'));
    }

    public function update(TicketRequest $ticketRequest, UserRequest $userRequest, Ticket $ticket):RedirectResponse {
        $formFields = $ticketRequest->safe()->except(['status']);
        $bool = 0;

        $status_id = Status::where('status', $ticketRequest->safe()->only(['status']))->first()->id;

        $user = User::where('email', $userRequest->safe()->only(['email']))->first();

        if (!$user->id) {
            return back()->withErrors(['email' => 'The provided email is not associated with any user']);
        }

        if ($ticket->user_id != $user->id) {
            $formFields['user_id'] = $user->id;
            $bool = 1;
        }
        if ($ticket->status_id != $status_id) {
            $formFields['status_id'] = $status_id;
        }

        $ticket->update($formFields);
        if($bool){
        event(new TicketAssigned($ticket));
        // $user->notify(new TicketAssigned($ticket));
        }
        return redirect('/')->with('message', 'Ticket updated');

        
    }

    public function destroy(Ticket $ticket):RedirectResponse{
        $ticket->delete();

        return redirect('/')->with('message', 'Ticket deleted');
    
    }
    
}
