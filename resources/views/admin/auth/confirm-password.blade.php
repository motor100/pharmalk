<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Это защищенная область администратора. Пожалуйста, подтвердите свой пароль, прежде чем продолжить.') }}
    </div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('admin.password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-label for="password" :value="__('Пароль')" />

            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-4">
            <x-button>
                {{ __('Подтвердить') }}
            </x-button>
        </div>
    </form>

</x-guest-layout>
