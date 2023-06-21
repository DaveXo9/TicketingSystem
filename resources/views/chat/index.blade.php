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
                <div class="flex justify-end mb-4">
                    <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                        Welcome to the group, everyone!
                    </div>
                    <div class="bg-blue-400 text-white rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">L</div>
                </div>
                <!-- Add more chat messages here -->
            </div>
            <div class="py-5">
                <input
                    class="w-full bg-gray-300 py-5 px-3 rounded-xl"
                    type="text"
                    placeholder="Type your message here..."
                />
            </div>
        </div>
        <!-- end message -->
    </div>
</div>


</x-layout>
