<x-layout :route="'/tickets'"> 
    <div class="flex justify-center mx-auto">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Ticket Form
            </p>
            <div class="leading-loose">
                <form method="POST" action="/tickets/{{$ticket->id}}" class="p-10 bg-white rounded shadow-xl">
                    @csrf
                    @method('PUT')
                <p class="text-xl pb-6 flex items-center">
                    Ticket
                </p>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="email">Agent Email</label>
                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" placeholder="Your Email" value="{{$ticket->user->email}}" aria-label="Email">
                
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="">
                    <label class="block text-sm text-gray-600" for="title">Title</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="title" name="title" type="text" value="{{$ticket->title}}"  placeholder="Ticket title" aria-label="Title">
                    
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                </div>
                <div class="mt-2">
                <label class="block text-sm text-gray-600" for="description">Description</label>
                <textarea
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="description" name="description" value="{{$ticket->description}}" rows="4" placeholder="Enter your description">{{$ticket->description}}</textarea>
                
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-2"> 
                    <label class="block text-sm text-gray-600" for="priority">Priority</label>
                    <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="priority" name="priority" type="text" placeholder="Ticket priority" aria-label="Priority">
                        <option value="Low" {{ $ticket->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $ticket->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $ticket->priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="mt-2"> 
                    <label class="block text-sm text-gray-600" for="status">Status</label>
                    <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="status" name="status" type="text" placeholder="Ticket status" aria-label="Status">
                        <option value="Open" {{ $ticket->status->status == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In progress" {{ $ticket->status->status == 'In progress' ? 'selected' : '' }}>In progress</option>
                        <option value="Closed" {{ $ticket->status->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    
                </div>
                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>