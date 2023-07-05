<x-layout :route="'/tickets'"> 
    <div class="my-4">
      <div class="max-w-3xl min-h-80 px-6 py-8 mx-auto bg-gray-50 rounded-lg shadow-md dark:bg-gray-100" style="cursor: auto;">
        <div class="flex items-center justify-between">
          <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{$ticket->created_at}}</span> 
          <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500">{{$ticket->status->status}}</a>
        </div> 
        <div class="mt-2">
          <a class="text-2xl font-bold text-black dark:text-black hover:text-gray-600 dark:hover:text-gray-200 hover:underline">{{$ticket->title}}</a> 
          <p class="mt-2 text-black-600 dark:text-black-300">{{$ticket->description}}</p>
        </br>
          <a class="px-3 py-2 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500">{{$ticket->priority}}</a>
        </div> 
        <div class="flex items-center justify-between mt-4">
          <div class="flex items-center">
            <a class="font-bold text-gray-700 cursor-pointer dark:text-black-200">{{$ticket->client->name}}</a>
          </div>
          <div class="flex items-center">
            <a href="/tickets/{{$ticket->id}}/edit" class="mr-2 text-blue-600 hover:text-blue-800">
              <i class="fas fa-edit"></i>
            </a>
            <form action="/tickets/{{$ticket->id}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </br>
  </br>
    <div class="max-w-2xl mx-auto">
      <h2 class="text-xl font-bold mb-4">Comments</h2>


    @unless(count($ticket->comments) == 0)

    @foreach($ticket->comments as $comment)
    <x-comment-card :comment="$comment" />
    @endforeach
    
    @else
    <p class="text-l font-bold mb-8 mt-8">No comments found</p>
    @endunless

    <x-comment-form :ticket="$ticket"/>
    </div>
    
  </div>
    
  </x-layout>
  