<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="matric_no" :value="__('Matric Number')" />
            <x-text-input id="matric_no" class="block mt-1 w-full" type="text" name="matric_no" :value="old('matric_no')" required />
            <x-input-error :messages="$errors->get('matric_no')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="whatsapp" :value="__('WhatsApp Number (e.g. 60123456789)')" />
            <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp" :value="old('whatsapp')" placeholder="601..." />
            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telegram" :value="__('Telegram Username (Optional)')" />

            <div class="relative mt-1">

                <x-text-input id="telegram" class="block w-full pl-8" type="text" name="telegram" :value="old('telegram')" placeholder="@username" />
            </div>

            <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">* Fill at least one contact method.</p>
        </div>

        <div class="mt-4">
            <x-input-label for="matric_card" :value="__('Upload Matric Card (Image)')" />
            <input id="matric_card" type="file" name="matric_card" required
                   class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            <x-input-error :messages="$errors->get('matric_card')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
