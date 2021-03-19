<div>
    {{-- Success is as dangerous as failure. --}}
    <table class="min-w-full table-auto divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                ID
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Client Code
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Address
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Contact #
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Contact Person
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <form wire:submit.prevent="submit">
            <tr class="mb-5">
                <td></td>
                <td>
                    <x-input type="text" wire:model.lazy="client.client_code" placeholder="Client Code" />
                    @error('client.client_code')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <x-input type="text" wire:model.lazy="client.name" placeholder="Name" />
                    @error('client.name')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <x-input  type="text" wire:model.lazy="client.address" placeholder="Address" />
                    @error('client.address')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <x-input wire:model.lazy="client.email" type="email" placeholder="Email" />
                    @error('client.email')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <x-input type="text" wire:model.lazy="client.contact_no" placeholder="Contact No" />
                    @error('client.contact_no')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <x-input type="text" wire:model.lazy="client.contact_person" placeholder="Contact Person" />
                    @error('client.contact_person')<p class="text-xs text-red-300">{{$message}}</p>@enderror
                </td>
                <td>
                    <button class="rounded-sm bg-red-300 p-2" type="button" wire:click="resetForm">✕</button>
                    <button class="rounded-sm bg-green-300 p-2" type="submit">✓</button>
                </td>
            </tr>
        </form>

        @foreach($clients as $client)
            <tr class="hover:bg-red-200" wire:click="editRow({{$client}})">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->id}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->client_code}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->name}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->address}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->email}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->contact_no}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$client->contact_person}}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $clients->links() }}
</div>
