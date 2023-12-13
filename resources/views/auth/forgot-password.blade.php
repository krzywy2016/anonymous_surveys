<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div style="min-width: 30vh">
                <a href="/">
                    <img src="{{asset('logo.svg')}}"/>
                </a>
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Zapomniałeś/aś hasła? To nie problem. Podaj nam swój adres email, a my prześlemy Ci link do utworzenia nowego.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Podaj email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('ZRESETUJ HASŁO') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
