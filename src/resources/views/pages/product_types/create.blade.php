<x-product-type-layout>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="POST" action="{{ route('product-types.store') }}">
    @csrf

    <!-- Email Address -->
        <div>
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block mt-1 p-2 w-full" type="string" name="name" :value="old('name')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-3">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</x-product-type-layout>
