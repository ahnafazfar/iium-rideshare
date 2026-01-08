<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ride Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(Auth::user()->verified || Auth::user()->role === 'admin')
            <div class="mb-6">
                <a href="{{ route('rides.create') }}"
                   style="background-color: #2563eb; color: white; display: inline-block; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                   class="hover:bg-blue-700 shadow">
                    + Post a New Ride
                </a>
            </div>
            @else
            <div style="background-color: #fffbeb; border: 1px solid #fcd34d; color: #92400e; padding: 16px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: start; gap: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; color: #f59e0b; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <div>
                    <h4 style="font-weight: bold; margin: 0 0 4px 0; font-size: 16px;">Account Verification Pending</h4>
                    <p style="margin: 0; font-size: 14px; line-height: 1.5;">
                        You can view existing rides, but you cannot post new ones until an Admin verifies your Matric Card.
                    </p>
                </div>
            </div>
            @endif

            @foreach ($rides as $ride)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6" style="margin-bottom: 24px;">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-start" style="display: flex; align-items: flex-start;">

                        <div style="flex-grow: 1;">
                            <h3 class="text-lg font-bold text-indigo-600" style="color: #4f46e5; font-size: 18px; margin-bottom: 4px;">
                                {{ $ride->pickup }} ➝ {{ $ride->dropoff }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400" style="margin-bottom: 4px;">
                                <strong>Time:</strong> {{ $ride->time }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1" style="font-size: 14px; color: #6b7280; margin-bottom: 12px;">
                                Posted by: {{ $ride->user->name }}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2">

                                @if($ride->user->whatsapp)
                                <a href="https://wa.me/{{ $ride->user->whatsapp }}" target="_blank"
                                   style="background-color: #25D366; color: white; padding: 8px 14px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                                @endif

                                @if($ride->user->telegram)
                                <a href="https://t.me/{{ $ride->user->telegram }}" target="_blank"
                                   style="background-color: #0088cc; color: white; padding: 8px 14px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                    </svg>
                                    Telegram
                                </a>
                                @endif

                                @if(!$ride->user->whatsapp && !$ride->user->telegram)
                                <span class="text-xs text-gray-400 italic">No contact info provided</span>
                                @endif
                            </div>
                        </div>

                        @if(auth()->id() === $ride->user_id || auth()->user()->role === 'admin')
                        <div style="margin-left: auto;">
                            <form method="POST" action="{{ route('rides.destroy', $ride) }}">
                                @csrf @method('DELETE')
                                <button style="background-color: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;"
                                        class="hover:bg-red-700 shadow"
                                        onclick="return confirm('Are you sure you want to delete this ride order?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach

            @if($rides->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No active ride orders yet.</p>
                <p class="text-gray-400 text-sm">Be the first to post a ride!</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
