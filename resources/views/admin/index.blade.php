<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel - Pending Verifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($users->isEmpty())
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                <p>No pending users found. All caught up!</p>
            </div>
            @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                @foreach($users as $user)
                <div style="background-color: rgb(31, 41, 55); color: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); border: 1px solid #4b5563; display: flex; flex-direction: column;">

                    <div style="display: flex; gap: 20px; margin-bottom: 20px;">

                        <div style="flex: 1; min-width: 0;">

                            <div style="margin-bottom: 12px;">
                                <h3 style="font-weight: bold; font-size: 18px; color: white; margin-bottom: 2px; word-wrap: break-word;">{{ $user->name }}</h3>
                                <p style="color: #9ca3af; font-size: 14px; word-wrap: break-word;">{{ $user->email }}</p>
                            </div>

                            <div style="margin-bottom: 12px;">
                                        <span style="background-color: #1e3a8a; color: #bfdbfe; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: bold; display: inline-block; border: 1px solid #1e40af;">
                                            {{ $user->matric_no }}
                                        </span>
                            </div>

                            <div style="font-size: 13px; color: #d1d5db; display: flex; flex-direction: column; gap: 6px;">

                                @if($user->whatsapp)
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span style="color: #4ade80; font-weight: bold;">WA:</span>
                                    <span>+{{ $user->whatsapp }}</span>
                                </div>
                                @endif

                                @if($user->telegram)
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span style="color: #60a5fa; font-weight: bold;">TG:</span>
                                    <span>@ {{$user->telegram}}</span>
                                </div>
                                @endif

                                @if(!$user->whatsapp && !$user->telegram)
                                <span style="color: #9ca3af; font-style: italic;">No contact info</span>
                                @endif
                            </div>

                        </div>

                        <div style="flex-shrink: 0; width: 140px;">
                            @if($user->matric_card_path)
                            <div style="border: 2px dashed #4b5563; border-radius: 8px; padding: 2px; overflow: hidden; background-color: #111827; height: 140px; display: flex; align-items: center; justify-content: center;">
                                <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank" style="display: block; width: 100%; height: 100%;">
                                    <img src="{{ asset('storage/' . $user->matric_card_path) }}"
                                         alt="ID"
                                         style="width: 100%; height: 100%; object-fit: contain;">
                                </a>
                            </div>
                            <div style="text-align: center; margin-top: 4px;">
                                <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank" style="font-size: 11px; color: #60a5fa; text-decoration: none;">
                                    View Full
                                </a>
                            </div>
                            @else
                            <div style="width: 140px; height: 140px; background-color: #374151; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #4b5563;">
                                <span style="color: #f87171; font-size: 10px;">No Image</span>
                            </div>
                            @endif
                        </div>

                    </div>

                    <div style="display: flex; gap: 10px; margin-top: auto;">

                        <form method="POST" action="{{ route('admin.verify', $user) }}" style="flex: 1;">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="hover:bg-blue-600"
                                    style="width: 100%; background-color: #2563eb; color: white; padding: 10px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer; transition: background 0.2s;">
                                Verify
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.delete', $user) }}" onsubmit="return confirm('Are you sure you want to reject and delete this user?');" style="flex: 1;">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="hover:bg-red-500"
                                    style="width: 100%; background-color: #ef4444; color: white; padding: 10px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer; transition: background 0.2s;">
                                Reject
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach

            </div>
            @endif

        </div>
    </div>
</x-app-layout>
