@props(['ticket'])
<form method="POST" action="/comments" class="bg-white p-4 rounded-lg shadow-md">
    @csrf
    <h3 class="text-lg font-bold mb-2">Add a comment</h3>
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="comment">
            Comment
        </label>
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="comment" name="comment" value="{{old('comment')}}" rows="3" placeholder="Enter your comment"></textarea>

            @error('comment')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
    </div>
    <div class="mb-6 register-form">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Submit
        </button>
      </div>
    </form>
