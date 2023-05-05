@props(['comment'])

    <div class="flex flex-col space-y-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-bold">{{$comment->user->name}}</h3>
            <p class="text-gray-700 text-sm mb-2">{{$comment->created_at}}</p>
            <p class="text-gray-700">{{$comment->comment}}</p>
        </br>
            <div class="flex items-center justify-end">
                <a href="/comments/{{$comment->id}}/edit" class="mr-2 text-blue-600 hover:text-blue-800">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="/comments/{{$comment->id}}" method="POST">
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