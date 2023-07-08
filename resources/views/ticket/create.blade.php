
<x-layout :route="'/tickets'"> 
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #client-list {
            display: none;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 5px;
            border-radius: 4px;
        }
    
        #client-list li {
            cursor: pointer;
            padding: 5px;
        }
    
        #client-list li:hover {
            background-color: #f1f1f1;
        }
    </style>
    
    <script>
        $(document).ready(function() {
            // Define an array of client data from the server-side
            var clients = {!! json_encode($clients) !!};
    
            // Autocomplete functionality on the 'name' input field
            $("#name").on("input", function() {
                var nameInput = $(this).val().toLowerCase();
    
                var matchingClients = clients.filter(function(client) {
                    return client.name.toLowerCase().includes(nameInput);
                });
    
                // Display the matching clients in a list
                var listItems = matchingClients.map(function(client) {
                    return "<li data-email='" + client.email + "' data-phone='" + client.phone_number + "'>" + client.name + "</li>";
                });
    
                $("#client-list").html(listItems.join(''));
    
                // Show or hide the client list based on the matching results
                if (matchingClients.length > 0 && nameInput.length > 0) {
                    $("#client-list").show();
                } else {
                    $("#client-list").hide();
                }
            });
    
            // When a client is clicked from the list
            $(document).on("click", "#client-list li", function() {
                var email = $(this).data("email");
                var phone = $(this).data("phone");
    
                $("#email").val(email);
                $("#phone_number").val(phone);
                $("#name").val($(this).text());
    
                $("#client-list").hide(); // Hide the list
            });
        });
    </script>
    

    <div class="flex justify-center mx-auto">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Ticket Form
            </p>
            <div class="leading-loose">
                <form method="POST" action="/tickets" class="p-10 bg-white rounded shadow-xl">
                    @csrf

                    <p class="text-xl pb-6 flex items-center">
                        Client
                    </p>
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text"  placeholder="Your Name" value="{{old('name')}}" aria-label="Name">

                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                    </div>
                    <ul id="client-list"></ul>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Email</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" placeholder="Your Email" value="{{old('emails')}}" aria-label="Email">
                    
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="Phone number">Phone number</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="phone_number" name="phone_number" type="text"  value="{{old('phone_number')}}" placeholder="Your Phone number" aria-label="Phone number">
                        
                        @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    
                    </div>
                </br>
                <p class="text-xl pb-6 flex items-center">
                    Ticket
                </p>
                <div class="">
                    <label class="block text-sm text-gray-600" for="title">Title</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="title" name="title" type="text" value="{{old('title')}}"  placeholder="Ticket title" aria-label="Title">
                    
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                </div>
                <div class="mt-2">
                <label class="block text-sm text-gray-600" for="description">Description</label>
                <textarea
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="description" name="description" value="{{old('description')}}" rows="4" placeholder="Enter your description"></textarea>
                
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-2"> 
                    <label class="block text-sm text-gray-600" for="priority">Priority</label>
                    <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="priority" name="priority" type="text" value="{{old('priority')}}"  placeholder="Ticket priority" aria-label="Priority">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>

                <div class="mt-2"> 
                    <label class="block text-sm text-gray-600" for="status">Status</label>
                    <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="status" name="status" type="text" value="{{old('status')}}"  placeholder="Ticket status" aria-label="Status">
                        <option value="Open">Open</option>
                        <option value="In progress">In progress</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>