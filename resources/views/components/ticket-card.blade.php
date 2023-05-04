@props(['ticket'])

<div class="my-4">
  <div class="max-w-2xl px-8 py-4 mx-auto bg-gray-50 rounded-lg shadow-md dark:bg-gray-100" style="cursor: auto;">

    <div class="flex items-center justify-between">
      <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{$ticket->created_at}}</span> 
      <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500">{{$ticket->status->status}}</a>
    </div> 
    <div class="mt-2">
      <a href="https://stackdiary.com/" class="text-2xl font-bold text-black dark:text-black hover:text-gray-600 dark:hover:text-gray-200 hover:underline">{{$ticket->title}}</a> 
      <p class="mt-2 text-black-600 dark:text-black-300 truncate">{{$ticket->description}}</p>
      <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500">{{$ticket->priority}}</a>

    </div> 
    <div class="flex items-center justify-between mt-4">
      <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Read more ⟶</a> 
      <div class="flex items-center">
        <a class="font-bold text-gray-700 cursor-pointer dark:text-black-200">{{$ticket->user->name}}</a>
      </div>
    </div>
  </div>
</div>
