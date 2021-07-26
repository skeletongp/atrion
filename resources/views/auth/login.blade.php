<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="w-44 h-44 rounded-full shadow-xl bg-cover" style="background-image: url('{{\App\Models\Company::get()->first()->logo}}')">

            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-md text-blue-600 hover:text-blue-900" href="{{ route('password.request') }}">
                        {{ __('Contraseña olvidada') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Acceder') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
