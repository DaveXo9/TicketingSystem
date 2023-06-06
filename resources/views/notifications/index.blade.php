<x-layout>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        
      Pusher.logToConsole = true;
      var pusherAppKey = "{{ env('PUSHER_APP_KEY') }}";
  
      var pusher = new Pusher(pusherAppKey, {
        cluster: 'eu'
      });
  
      var channel = pusher.subscribe('notifications');
      channel.bind('pusher:subscription_succeeded', function(members) {
        alert('successfully subscribed!');
      });
  
      var channel = pusher.subscribe('notifications');
      channel.bind('ticket-assigned', function(data) {
        console.log(data.title);
        appendNotification(data);
      });
  
      function appendNotification(data) {
        var notificationsDiv = document.getElementById('notifications');
        var notificationElement = document.createElement('div');
        notificationElement.innerHTML =
        '<div class="flex flex-col space-y-2 bg-white p-4 rounded-lg shadow-md">' +
          '<h3 class="text-lg font-bold mb-0">' +
          data.title +
          '</h3>' +
          '<p class="text-gray-700 text-sm">' +
          data.created_at +
          '</p>' +
          '<p class="text-gray-700">' +
          data.message +
          '</p>' + 
          '<a  href="' + data.url + '"  class="text-blue-600 dark:text-blue-400 hover:underline">View Ticket ⟶</a>'
          + '</div>' + '</br>';
          notificationsDiv.insertBefore(notificationElement, notificationsDiv.firstChild);
      }
    </script>
  <div class="max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Notifications</h2>
      <div id="notifications">

        @foreach ($notifications as $notification)
        <div class="flex flex-col space-y-2 bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-0">{{ $notification->title }}</h3>
            <p class="text-gray-700 text-sm">{{ $notification->created_at }}</p>
            <p class="text-gray-700">{{ $notification->message }}</p>
            <a href="{{ $notification->url }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Ticket ⟶</a>
        </div>
        <br>
    @endforeach
  
      </div>
    </div>
  </x-layout>
  