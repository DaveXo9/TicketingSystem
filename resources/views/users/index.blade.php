<x-layout>

    <div class="flex h-screen items-center justify-center">
        <div class="w-full rounded-xl p-12 shadow-2xl shadow-blue-200 md:w-8/12 lg:w-6/12 bg-white" style="margin-top: -10%;">
            <div class="grid grid-cols-1 gap-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 p-4 text-2xl text-blue-500 font-semibold">
                    {{ substr($user->name, 0, 1) }}
                  </div>
      
            <div class="text-center">
              <h2 class="text-2xl font-bold text-zinc-700">{{$user->name}}</h2>
              <p class="mt-4 text-zinc-500">Email: {{$user->email}}</p>
              <p class="mt-4 text-zinc-500">Joined: {{$user->created_at}}</p>


            </div>
      
            <div class="mt-6 grid grid-cols-2 gap-4">
                <a href="/users/{{$user->id}}/edit" class="w-full rounded-xl border-2 border-blue-500 bg-white px-3 py-2 font-semibold text-blue-500 hover:bg-blue-500 hover:text-white flex items-center justify-center">Edit Profile</a>
                <a href="/" class="w-full rounded-xl border-2 border-blue-500 bg-white px-3 py-2 font-semibold text-blue-500 hover:bg-blue-500 hover:text-white flex items-center justify-center">View tickets</a>
            </div>
          </div>
        </div>
      </div>
      

</x-layout>