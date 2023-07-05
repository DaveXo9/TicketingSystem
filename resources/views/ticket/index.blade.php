<x-layout :route="'/tickets'"> 
        <!-- your content goes here -->
        @unless(count($tickets) == 0)

        @foreach($tickets as $ticket)
        <x-ticket-card :ticket="$ticket" />
        @endforeach
        
        @else
        <p>No tickets found</p>
        @endunless

        <div class="mt-6 p-4">
        {{$tickets->links()}}
        </div>
        
        
</x-layout>