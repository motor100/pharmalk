<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="mb-8" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Почта')" class="label" />
            <x-text-input id="email" class="block input mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group mt-8">
            <x-input-label for="password" :value="__('Пароль')" class="label" />

            <x-text-input id="password" class="block input mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 mb-8">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="mb-6">
            <x-primary-button class="ms-3 primary-btn">
                {{ __('Войти') }}
            </x-primary-button>
        </div>

        @if (Route::has('password.request'))
            <div class="mb-8 text-center">
                <a class="underline forgot-password rounded-md focus:outline-none" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            </div>
        @endif
    </form>

    <a href="https://natura-pharma.ru" class="secondary-btn">Вернуться на главную страницу</a>
</x-guest-layout>
