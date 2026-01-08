<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <header style="margin-bottom: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" style="font-weight: bold; font-size: 18px;">
                            {{ __('Profile Information') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("These details are linked to your verification. Contact Admin if changes are needed.") }}
                        </p>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div style="background-color: #1f2937; padding: 10px;">
                            <label class="block font-medium text-xs text-gray-500 uppercase tracking-wider">Full Name</label>
                            <div class="mt-1 text-gray-900 dark:text-gray-100 font-bold text-lg">
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <div style="background-color: #1f2937; padding: 10px;">
                            <label class="block font-medium text-xs text-gray-500 uppercase tracking-wider">Matric Number</label>
                            <div class="mt-1 text-gray-900 dark:text-gray-100 font-bold text-lg">
                                {{ Auth::user()->matric_no }}
                            </div>
                        </div>

                        <div style="background-color: #1f2937; padding: 10px;">
                            <label class="block font-medium text-xs text-gray-500 uppercase tracking-wider">WhatsApp Number</label>
                            <div class="mt-1 dark:text-gray-100 font-bold text-lg">
                                @if(Auth::user()->whatsapp)
                                +{{ Auth::user()->whatsapp }}
                                @else
                                <span class="text-gray-400 italic text-sm">Not Provided</span>
                                @endif
                            </div>
                        </div>

                        <div style="background-color: #1f2937; padding: 10px;">
                            <label class="block font-medium text-xs text-gray-500 uppercase tracking-wider">Telegram Username</label>
                            <div class="mt-1 dark:text-gray-100 font-bold text-lg">
                                @if(Auth::user()->telegram)
                                @ {{ Auth::user()->telegram }}
                                @else
                                <span class="text-gray-400 italic text-sm">Not Provided</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
