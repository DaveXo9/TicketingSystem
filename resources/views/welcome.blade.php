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
    channel.bind('ticket-assigned', function(data) {
      showAlert(data);
    });

    function showAlert(data) {
      alert("Title: " + data['title'] +
            "\nCreated At: " + data.created_at +
            "\nMessage: " + data.message +
            "\nURL: " + data.url);
    }
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>notifications</code>
    with event name <code>ticket-assigned</code>.
  </p>
</body>
</html>
