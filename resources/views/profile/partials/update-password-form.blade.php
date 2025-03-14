<section class="profile-section">
    <header>
        <div class="profile-section-title">Обновить пароль</div>
        <div class="profile-section-subtitle">Убедитесь, что в вашей учетной записи используется длинный случайный пароль, чтобы обеспечить безопасность</div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Текущий пароль')" class="label" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="input-field" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('Новый пароль')" class="label" />
            <x-text-input id="update_password_password" name="password" type="password" class="input-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Подтвердить пароль')" class="label" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="submit-btn primary-btn">{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Сохранено') }}</p>
            @endif
        </div>
    </form>
</section>
