<x-client-layout>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="POST" action="{{ route('clients.store') }}">
    @csrf

    <!-- Email Address -->

        <div>
            <x-label for="client_code" :value="__('Client Code')" class="mt-2 mb-2"/>

            <x-input id="client_code" class="block mt-1 p-2 w-full" type="string" name="client_code" :value="old('client_code')" required autofocus />
        </div>

        <div>
            <x-label for="name" :value="__('Name')" class="mt-2 mb-2"/>

            <x-input id="name" class="block mt-1 p-2 w-full" type="string" name="name" :value="old('name')" required autofocus />
        </div>

        <div>
            <x-label for="address" :value="__('Address')" class="mt-2 mb-2"/>

            <x-input id="address" class="block mt-1 p-2 w-full" type="string" name="address" :value="old('address')" required autofocus />
        </div>

        <div>
            <x-label for="contact_no" :value="__('Contact No.')" class="mt-2 mb-2"/>

            <x-input id="contact_no" class="block mt-1 p-2 w-full" type="string" name="contact_no" :value="old('contact_no')" required autofocus />
        </div>


        <div>
            <x-label for="email" :value="__('Email')" class="mt-2 mb-2"/>

            <x-input id="email" class="block mt-1 p-2 w-full border-dark" type="email" name="email" :value="old('email')" required autofocus />
        </div>


        <div>
            <x-label for="contact_person" :value="__('Contact Person')" class="mt-2 mb-2"/>

            <x-input id="contact_person" class="block mt-1 p-2 w-full border-dark" type="string" name="contact_person" :value="old('contact_person')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-3">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</x-client-layout>
