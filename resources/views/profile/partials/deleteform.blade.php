<section class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 mt-10 space-y-6">
    <header class="border-b border-gray-200 dark:border-gray-700 pb-4">
        <h2 class="text-xl font-semibold text-black-900 dark:text-black-100">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-black-600 dark:text-black-300">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full py-3 text-center"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="" class="p-6 space-y-6">
            @csrf
            @method('delete')

            <h3 class="text-lg font-semibold text-black-900 dark:black-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h3>

            <p class="text-sm text-black-600 dark:text-black-300">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div>
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>