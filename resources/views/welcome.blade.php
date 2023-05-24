<!DOCTYPE html>
<html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5787e475a755e240c536', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('notifications');
    channel.bind('pusher:subscription_succeeded', function(members) {
    alert('successfully subscribed!');
});
    
    var channel = pusher.subscribe('my-channel');
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
      appendNotification(data);
      console.log(data);
    });

    function appendNotification(data) {
      var notificationsDiv = document.getElementById('notifications');
      var notificationElement = document.createElement('div');
      notificationElement.innerHTML = '<p>Title: ' + data.title + '</p>' +
                                      '<p>Created At: ' + data.created_at + '</p>' +
                                      '<p>Message: ' + data.message + '</p>' +
                                      '<p>URL: ' + data.url + '</p>';
      notificationsDiv.appendChild(notificationElement);
    }
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <div id="notifications"></div>
</body>
</html>
