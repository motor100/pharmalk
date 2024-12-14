<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group mb-12">
            <x-input-label for="email" :value="__('Почта')" class="label" />
            <x-text-input id="email" class="block mt-1 w-full input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-primary-button class="primary-btn">
                {{ __('Сбросить пароль') }}
            </x-primary-button>
        </div>

        <div class="mb-8 text-center">
            <a class="secondary-btn rounded-md focus:outline-none" href="{{ route('login') }}">Назад</a>
        </div>
    </form>
</x-guest-layout>
