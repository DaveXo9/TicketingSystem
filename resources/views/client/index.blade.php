<x-layout :route="'/tickets'"> 
  <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-users mr-3"></i> Clients
    </p>
</br>
    <section class="antialiased bg-gray-100 text-gray-600  px-4">
        <div class="flex flex-col justify-center h-full">
          <!-- Table -->
          <div class="w-full max-w-5xl max-h-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
              <h2 class="font-semibold text-gray-800 mt-4 mb-4">Clients</h2>
            </header>
            <div class="p-3">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                      <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Name</div>
                      </th>
                      <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Email</div>
                      </th>
                      <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Phone Number</div>
                      </th>
                      <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Actions</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($clients as $client)
                    <tr>
                      <td class="p-2 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="font-medium text-gray-800">{{ $client->name }}</div>
                        </div>
                      </td>
                      <td class="p-2 whitespace-nowrap">
                        <div class="text-left">{{ $client->email }}</div>
                      </td>
                      <td class="p-2 whitespace-nowrap">
                        <div class="text-left font-medium text-green-500">{{ $client->phone_number }}</div>
                      </td>
                      <td class="p-2 whitespace-nowrap">
                        <div class=" text-lg flex items-center justify-center">
                            <a href="/clients/{{$client->id}}/edit" class="mr-2 text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                              </a>

                              <form action="/clients/{{$client->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                  <i class="fas fa-trash-alt"></i>
                                </button>
                              </form>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="p-4 text-center text-gray-500">No clients found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    
    
</x-layout>