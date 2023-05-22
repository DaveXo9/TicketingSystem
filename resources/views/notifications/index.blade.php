<x-layout>

<div id="notification-container"></div>

@foreach ($notifications as $notification)

<div class="flex flex-col space-y-4">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">{{$notification->data['title']}}</h3>
        <p class="text-gray-700 text-sm mb-2">{{$notification->data['created_at']}}</p>
        <p class="text-gray-700">{{$notification->data['message']}}</p>
    </div>
</div>


@endforeach

</x-layout>