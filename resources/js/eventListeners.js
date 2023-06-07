import Echo from 'laravel-echo';

window.Echo.channel('notifications')
    .listen('.ticket-assigned', (data) => {
        console.log('New Ticket Assigned:', data);
        appendNotificationToDom(notification);
    });

    function appendNotificationToDom(notification) {
        const notificationContainer = document.getElementById('notification-container');
        const notificationElement = document.createElement('div');
        notificationElement.classList.add('flex', 'flex-col', 'space-y-4', 'bg-white', 'p-4', 'rounded-lg', 'shadow-md');
      
        const titleElement = document.createElement('h3');
        titleElement.classList.add('text-lg', 'font-bold', 'text-gray-900');
        titleElement.innerText = notification.data.title;
        notificationElement.appendChild(titleElement);
      
        const createdAtElement = document.createElement('p');
        createdAtElement.classList.add('text-sm', 'text-gray-700', 'mb-2');
        createdAtElement.innerText = notification.data.created_at;
        notificationElement.appendChild(createdAtElement);
      
        const messageElement = document.createElement('p');
        messageElement.classList.add('text-gray-700');
        messageElement.innerText = notification.data.message;
        notificationElement.appendChild(messageElement);
      
        notificationContainer.appendChild(notificationElement);
      }
      