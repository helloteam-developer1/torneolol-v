<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="nombreusuario" :value="__('Nombre completo')" />

                <x-text-input id="nombreusuario" class="block mt-1 w-full" type="text" name="nombreusuario" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="cupon" :value="__('Codigo de registro')" />

                <x-text-input id="cupon" class="block mt-1 w-full"
                                type="text"
                                name="cupon"
                                required  />
            </div>

            <!-- Confirm Password -->
        

            <div class="flex items-center justify-end mt-4">
            
                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
