<x-layout>
    <!-- component -->
    <!-- This is an example component -->
    <div class="container mx-auto shadow-lg rounded-lg">
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white">
            <!-- chat list -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto" style="max-height: 600px;">
                <!-- user list -->
                @foreach ($users as $user)
                    <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2" data-recipient-id="{{ $user->id }}">
                        <div class="w-1/4">
                            <div class="bg-blue-400 text-white rounded-full h-12 w-12 flex items-center justify-center text-2xl font-semibold">{{ substr($user->name, 0, 1) }}</div>
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">
                                <a href="/chat/{{$user->id}}">{{ $user->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Add more user list items here -->
            </div>
            <!-- end chat list -->

            <!-- message -->
            <div class="w-full px-5 flex flex-col justify-between">
                <div class="flex flex-col mt-5">
                    <!-- Add chat messages here -->
                    @foreach ($messages as $message)
                    @if ($message->user_id == Auth::id())
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            {{ $message->message }}
                        </div>
                        <div class="bg-blue-400 text-white rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">L</div>
                    </div>
                    @else
                    <div class="flex justify-start mb-4">
                        <div class="flex items-center">
                            <div class="bg-gray-200 text-black rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">J</div>
                            <div class="ml-2 py-3 px-4 bg-gray-200 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-black">
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <!-- Add more chat messages here -->
                </div>
                <div class="flex items-center py-5">
                    <input class="flex-grow bg-gray-300 py-3 px-3 rounded-l-xl" type="text" placeholder="Type your message..." />
                    <button class="bg-blue-400 text-white px-4 py-3 rounded-r-xl">Send</button>
                </div>
            </div>
            <!-- end message -->
        </div>
    </div>
</x-layout>
