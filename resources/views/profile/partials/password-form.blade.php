<section class="max-w-xl mx-auto p-6 mt-10">
    <header class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-black-100">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-black-300">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    autocomplete="current-password" placeholder="Enter current password" class="block w-full pr-10" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.105-.672-2-1.5-2S9 9.895 9 11s.672 2 1.5 2 1.5-.895 1.5-2zM12 14v1m-3-1v1m6-1v1M5 11c0-3.866 3.134-7 7-7s7 3.134 7 7c0 1.457-.46 2.798-1.24 3.89M16.8 18a3 3 0 01-6.6 0" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password"
                    placeholder="Enter new password" class="block w-full pr-10" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.105-.672-2-1.5-2S9 9.895 9 11s.672 2 1.5 2 1.5-.895 1.5-2zM12 14v1m-3-1v1m6-1v1M5 11c0-3.866 3.134-7 7-7s7 3.134 7 7c0 1.457-.46 2.798-1.24 3.89M16.8 18a3 3 0 01-6.6 0" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password" placeholder="Confirm new password" class="block w-full pr-10" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.105-.672-2-1.5-2S9 9.895 9 11s.672 2 1.5 2 1.5-.895 1.5-2zM12 14v1m-3-1v1m6-1v1M5 11c0-3.866 3.134-7 7-7s7 3.134 7 7c0 1.457-.46 2.798-1.24 3.89M16.8 18a3 3 0 01-6.6 0" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                    x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>