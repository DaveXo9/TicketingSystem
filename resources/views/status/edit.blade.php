<x-layout :route="'/tickets'"> 

    <div class="max-w-2xl mx-auto">
    <form method="POST" action="/status/{{$status->id}}" class="bg-white p-4 rounded-lg shadow-md">
        @method('PUT')
        @csrf
        <h3 class="text-lg font-bold mb-2">Update a status</h3>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="status">
                Status
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="status" name="status" value="{{$status->status}}" rows="3" placeholder="Enter your comment"/>
    
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
    </div>
    </x-layout>