<x-layout> 
        <!-- your content goes here -->
        @unless(count($tickets) == 0)

        @foreach($tickets as $ticket)
        <x-ticket-card :ticket="$ticket" />
        @endforeach
        
        @else
        <p>No tickets found</p>
        @endunless
        
        
</x-layout>