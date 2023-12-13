<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div style="min-width: 30vh">
                <a href="/">
                    <img src="{{asset('logo.png')}}"/>
                </a>
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Dziękujemy za rejestrację! Aby aktywować konto, należy zweryfikować swój adres e-mail klikając w link, który właśnie do Ciebie wysłaliśmy. Jeśli nie otrzymałeś e-maila, chętnie wyślemy Ci kolejny.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Nowy link weryfikacyjny został wysłany na adres e-mail podany podczas rejestracji.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Wyślij link ponownie') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Wyloguj') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
