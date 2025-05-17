<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenants') }}
            <x-btn-link href="{{ route('tenants.create') }}" class="float-end">Tenant Create</x-btn-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="pb-3 fw-bold">{{ __("Tenant List") }}</h4>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Domains</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>
                                        @foreach ($item->domains as $domain)
                                            <a href="{{ request()->isSecure() ? 'https://' : 'http://' }}{{ $domain['domain'] }}:8000" target="_blank">{{ $domain['domain'] }}</a><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('tenants.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
