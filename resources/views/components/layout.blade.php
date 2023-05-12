<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing System</title>
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
        .register-form .bg-laravel { background: #3d68ff; }
        .text-laravel {
  color: #3d68ff;
}
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="/" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Ticketing System</a>
            <a href="/tickets/create" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Ticket
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="flex items-center text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/tickets/index" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Tickets
            </a>
            <a href="/clients" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                Clients
            </a>
            <a href="/status" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Statuses
            </a>
            <a href="/profile" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-user mr-3"></i>
                Profile
            </a>

        </nav>
      </aside>


    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="flex items-center justify-between bg-white py-2 px-6">
            <div class="w-1/2"></div>
            <form action="/tickets/index" class="flex justify-center w-full max-w-md mx-auto">
            
                <div class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden border border-gray-300">
                <div class="grid place-items-center h-full w-12 text-blue-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input class="peer h-full w-full outline-none text-sm text-gray-700 pr-2" type="text" id="search" name="search" placeholder="Search something.." />
            </div>
    </form>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
              @auth
              <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none ml-4">
                <span>{{ Str::limit(auth()->user()->name, 1, '') }}</span>
              </button>
              <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
              <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/profile" class="block px-4 py-2 account-link hover:text-white">Account</a>
                <form class="block px-4 py-2 account-link hover:text-white" method="POST" action="/logout">
                  @csrf
                  <button type="submit">
                    Logout
                  </button>
                </form>
              </div>
              @else
              <a href="/login" class="block px-4 py-2 hover:text-blue-600"> <i class="fas fa-sign-in-alt"></i> Login</a>
              <a href="/register" class="block px-4 py-2 hover:text-blue-600"><i class="fas fa-user-plus"></i> Register</a>
              @endauth
            </div>
          </header>
          
        
        

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Ticketing System</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="/" class="flex items-center text-white py-4 pl-6 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="/tickets/index" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Tickets
                </a>
                <a href="/clients" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Clients
                </a>
                <a href="/status" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Statuses
                </a>
                <a href="/profile" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    Profile
                </a>

            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                {{$slot}}
            </main>

        </div>
        
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</body>
</html>