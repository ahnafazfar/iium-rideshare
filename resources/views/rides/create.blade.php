<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post a New Ride') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('rides.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="pickup" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pickup Location</label>
                            <input type="text"
                                   name="pickup"
                                   id="pickup"
                                   placeholder="e.g. Mahallah Ali"
                                   required
                                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; margin-top: 4px;"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                        </div>

                        <div class="mb-4">
                            <label for="dropoff" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Drop-off Location</label>
                            <input type="text"
                                   name="dropoff"
                                   id="dropoff"
                                   placeholder="e.g. KL Sentral"
                                   required
                                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; margin-top: 4px;"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                        </div>

                        <div class="mb-6">
                            <label for="time" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Time</label>
                            <input type="text"
                                   name="time"
                                   id="time"
                                   placeholder="e.g. Tomorrow 10:00 AM"
                                   required
                                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; margin-top: 4px;"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-900 text-sm underline mr-4">Cancel</a>

                            <button type="submit"
                                    style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                Post Ride
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
