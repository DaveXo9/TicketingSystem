<x-layout>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
      Pusher.logToConsole = true;
      var pusherAppKey = "{{ env('PUSHER_APP_KEY') }}";
      var userId = "{{ Auth()->user()->id }}";
      var recipientId = "{{ $recepient_id }}";
      var chatIds = [Math.min(userId, recipientId), Math.max(userId, recipientId)];

  
      var pusher = new Pusher(pusherAppKey, {
      cluster: 'eu',
      authEndpoint: '/broadcasting/auth',
      auth: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
      },
    });
  
      var channel = pusher.subscribe('private-chat.' + chatIds[0] + '_' + chatIds[1]); // Include the user ID as part of the channel name
      channel.bind('pusher:subscription_succeeded', function() {
        alert('Successfully subscribed!');
      });
  
      channel.bind('pusher:subscription_error', function(status) {
        alert('Subscription failed with status ' + status);
      });
  
      channel.bind('message-sent', function(data) {
        console.log(data.message.message);
        appendMessage(data);
      });
      
      function appendMessage(data) {
        var messageDiv = document.createElement('div');
        messageDiv.classList.add('flex', 'justify-end', 'mb-4');

        var messageContent = document.createElement('div');
        messageContent.classList.add('mr-2', 'py-3', 'px-4', 'bg-blue-400', 'rounded-bl-3xl', 'rounded-tl-3xl', 'rounded-tr-xl', 'text-white');
        messageContent.textContent = data.message.message;

        var userAvatar = document.createElement('div');
        userAvatar.classList.add('bg-blue-400', 'text-white', 'rounded-full', 'h-8', 'w-8', 'flex', 'items-center', 'justify-center', 'text-xs', 'font-semibold');
        userAvatar.textContent = '{{ substr(auth()->user()->name, 0, 1) }}';

        messageDiv.appendChild(messageContent);
        messageDiv.appendChild(userAvatar);

        var chatMessagesContainer = document.querySelector('.flex.flex-col.mt-5.overflow-y-auto');
        chatMessagesContainer.appendChild(messageDiv);
      } 


      function sendMessage(message) {
            console.log('sending message');
            var url = '/chat';
            var data = {
                message: message,
                recepient_id: recipientId,
                _token: '{{ csrf_token() }}'
            };

            // Send the AJAX request
            $.post(url, data, function(response) {
                console.log("here");
            });
        }

        // Event listener for the send button click
        $(document).on('click', '#send-button', function() {
        console.log('send button clicked');
        var message = document.getElementById('message-input').value;
        sendMessage(message);
        document.getElementById('message-input').value = '';
});

      </script>

    <!-- component -->
    <!-- This is an example component -->
    <div class="container mx-auto shadow-lg rounded-lg">
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white">
            <!-- chat list -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto" style="max-height: 640px;">
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
                <div class="flex flex-col mt-5 overflow-y-auto" style="max-height:600px">
                    <!-- Add chat messages here -->
                    @foreach ($messages as $message)
                    @if ($message->user_id == Auth::id())
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            {{ $message->message }}
                        </div>
                        <div class="bg-blue-400 text-white rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">{{ substr($message->user->name, 0, 1) }}</div>
                    </div>
                    @else
                    <div class="flex justify-start mb-4">
                        <div class="flex items-center">
                            <div class="bg-gray-200 text-black rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">{{ substr($message->user->name, 0, 1) }}</div>
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
                    <input type="hidden" name="recepient_id" value="{{ $recepient_id }}">
                    <input class="flex-grow bg-gray-300 py-3 px-3 rounded-l-xl" type="text" id = "message-input" placeholder="Type your message..." />
                    <button class="bg-blue-400 text-white px-4 py-3 rounded-r-xl" id="send-button" name="send-button">Send</button>
                </div>
            </div>
            <!-- end message -->
        </div>
    </div>
</x-layout>
