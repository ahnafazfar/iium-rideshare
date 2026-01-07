<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ride Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->verified)
            <div class="mb-6">
                <a href="{{ route('rides.create') }}"
                   style="background-color: #2563eb; color: white; display: inline-block; padding: 10px 20px; border-radius: 6px; text-decoration: none;"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Post a New Ride
                </a>
            </div>
            @else
            <div style="background-color: #fef9c3; border-left: 4px solid #eab308; color: #854d0e; padding: 16px; margin-bottom: 24px;" role="alert">
                <p style="font-weight: bold; margin-bottom: 4px;">Account Pending</p>
                <p>You can view rides, but you need to wait for Admin verification to post new rides.</p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rides as $ride)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $ride->pickup }} <span class="text-gray-400">➜</span> {{ $ride->dropoff }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-1">🕒 {{ $ride->time }}</p>
                            <p class="text-sm text-gray-500 mt-2">Posted by: {{ $ride->user->name }}</p>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @if($ride->user->whatsapp)
                        <a href="https://wa.me/{{ $ride->user->whatsapp }}" target="_blank"
                           style="background-color: #25D366; color: white; padding: 6px 12px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 14px; display: inline-flex; items-center: center; gap: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/>
                            </svg>
                            WhatsApp
                        </a>
                        @endif

                        @if($ride->user->telegram)
                        <a href="https://t.me/{{ $ride->user->telegram }}" target="_blank"
                           style="background-color: #0088cc; color: white; padding: 6px 12px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 14px; display: inline-flex; items-center: center; gap: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.53.298-.486.494.075.344.35.45.94.675.12.047.28.106.495.182.26.09.56.24.6.28.06.06.043.19.017.245l-.475 2.07c-.035.156-.11.23-.217.243-.105.012-.25-.05-.37-.17l-.88-.868-.076-.076-.02-.02c-.06-.06-.11-.11-.18-.18l-.135-.135c-.176-.176-.325-.325-.565-.565l.595 1.76c.07.215.345.24.475.055l3.235-4.57c.185-.26.4-.33.275-.545-.115-.195-.44-.09-.64.03l-4.14 2.49c-.195.115-.405.03-.455-.17l-.145-.58c-.08-.32.18-.545.525-.71 2.91-1.39 4.88-2.32 5.91-2.79.625-.285 1.135-.37 1.345.135.105.255.035.615-.145.895z"/>
                            </svg>
                            Telegram
                        </a>
                        @endif

                        @if(auth()->id() === $ride->user_id || auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('rides.destroy', $ride) }}" class="ml-auto">
                            @csrf @method('DELETE')
                            <button style="background-color: #ef4444; color: white; padding: 6px 12px; border-radius: 6px; font-weight: bold;"
                                    class="hover:bg-red-700 shadow">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 py-10">
                    No rides available right now. Be the first to post one!
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
