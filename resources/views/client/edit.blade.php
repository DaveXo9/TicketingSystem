<x-layout>
    <div class="flex justify-center mx-auto">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Client Form
            </p>
<div class="leading-loose">
    <form method="POST" action="/clients/{{$client->id}}" class="p-10 bg-white rounded shadow-xl">
        @csrf

        <p class="text-xl pb-6 flex items-center">
            Client
        </p>
        <div class="">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text"  placeholder="Your Name" value="{{$client->name}}" aria-label="Name">

            @error('name')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Email</label>
            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" placeholder="Your Email" value="{{$client->email}}"  aria-label="Email">
        
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="mt-2">
            <label class=" block text-sm text-gray-600" for="Phone number">Phone number</label>
            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="phone_number" name="phone_number" type="text"  value="{{$client->phone_number}}"  placeholder="Your Phone number" aria-label="Phone number">
            
            @error('phone_number')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        
        </div>
        <div class="mt-6">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
        </div>
    </div>
    </div>
</div>
</x-layout>