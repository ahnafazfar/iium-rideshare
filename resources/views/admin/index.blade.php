<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'pending' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex space-x-8 mb-6 border-b border-gray-200 dark:border-gray-700">

                <button @click="activeTab = 'pending'"
                        :class="activeTab === 'pending'
                            ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700'
                            : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300'"
                        class="inline-flex items-center px-1 pt-1 pb-3 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                    Pending Verifications

                    @if($pending_users->count() > 0)
                    <span class="ml-2 bg-red-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">
                            {{ $pending_users->count() }}
                        </span>
                    @endif
                </button>

                <button @click="activeTab = 'all'"
                        :class="activeTab === 'all'
                            ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700'
                            : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300'"
                        class="inline-flex items-center px-1 pt-1 pb-3 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                    All Users
                </button>
            </div>


            <div x-show="activeTab === 'pending'" x-cloak>
                @if($pending_users->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    <p>No pending users found. All caught up!</p>
                </div>
                @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($pending_users as $user)
                    <div style="background-color: rgb(31, 41, 55); color: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); border: 1px solid #4b5563; display: flex; flex-direction: column;">
                        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                            <div style="flex: 1; min-width: 0;">
                                <div style="margin-bottom: 12px;">
                                    <h3 style="font-weight: bold; font-size: 18px; color: white;">{{ $user->name }}</h3>
                                    <p style="color: #9ca3af; font-size: 14px;">{{ $user->email }}</p>
                                </div>
                                <span style="background-color: #1e3a8a; color: #bfdbfe; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: bold; display: inline-block;">{{ $user->matric_no }}</span>

                                <div style="margin-top: 10px; font-size: 13px; color: #d1d5db; display: flex; flex-direction: column; gap: 4px;">
                                    @if($user->whatsapp)
                                    <div style="display: flex; items-center: center; gap: 6px;">
                                        <span style="color: #4ade80; font-weight: bold;">WA:</span> +{{ $user->whatsapp }}
                                    </div>
                                    @endif
                                    @if($user->telegram)
                                    <div style="display: flex; items-center: center; gap: 6px;">
                                        <span style="color: #60a5fa; font-weight: bold;">TG:</span> @ {{ $user->telegram }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div style="flex-shrink: 0; width: 140px;">
                                @if($user->matric_card_path)
                                <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $user->matric_card_path) }}" style="width: 140px; height: 100px; object-fit: contain; background: #111827; border: 1px solid #4b5563; border-radius: 6px;">
                                </a>
                                <div style="text-align: center; margin-top: 4px;">
                                    <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank" style="font-size: 11px; color: #60a5fa; text-decoration: none;">View Full</a>
                                </div>
                                @else
                                <div style="width: 140px; height: 100px; background: #374151; display: flex; align-items: center; justify-content: center; color: #f87171; font-size: 10px;">No Image</div>
                                @endif
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: auto;">
                            <form method="POST" action="{{ route('admin.verify', $user) }}" style="flex: 1;">
                                @csrf @method('PATCH')
                                <button type="submit" class="hover:bg-blue-600" style="width: 100%; background-color: #2563eb; color: white; padding: 10px; border-radius: 6px; font-weight: bold;">Verify</button>
                            </form>
                            <form method="POST" action="{{ route('admin.delete', $user) }}" onsubmit="return confirm('Reject and delete?');" style="flex: 1;">
                                @csrf @method('DELETE')
                                <button type="submit" class="hover:bg-red-500" style="width: 100%; background-color: #ef4444; color: white; padding: 10px; border-radius: 6px; font-weight: bold;">Reject</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>


            <div x-show="activeTab === 'all'" x-cloak>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-x-auto">
                    <div class="p-6">
                        <table style="width: 100%; border-collapse: collapse; color: #d1d5db; min-width: 800px;">
                            <thead>
                            <tr style="border-bottom: 2px solid #374151; text-align: left;">
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Name</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Email</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Matric No</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">WhatsApp</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Telegram</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">ID Card</th>
                                <th style="padding: 12px; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Status</th>
                                <th style="padding: 12px; text-align: right; color: #9ca3af; font-size: 12px; text-transform: uppercase;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_users as $user)
                            <tr style="border-bottom: 1px solid #374151;">
                                <td style="padding: 12px; font-weight: bold; color: white;">
                                    {{ $user->name }}
                                </td>

                                <td style="padding: 12px; color: #d1d5db; font-size: 14px;">
                                    {{ $user->email }}
                                </td>

                                <td style="padding: 12px;">{{ $user->matric_no }}</td>

                                <td style="padding: 12px;">
                                    @if($user->whatsapp)
                                    <span class="text-green-400">+{{ $user->whatsapp }}</span>
                                    @else
                                    <span class="text-gray-600">-</span>
                                    @endif
                                </td>

                                <td style="padding: 12px;">
                                    @if($user->telegram)
                                    <span class="text-blue-400">@ {{ $user->telegram }}</span>
                                    @else
                                    <span class="text-gray-600">-</span>
                                    @endif
                                </td>

                                <td style="padding: 12px;">
                                    @if($user->matric_card_path)
                                    <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $user->matric_card_path) }}"
                                             alt="ID"
                                             style="width: 40px; height: 30px; object-fit: cover; border-radius: 4px; border: 1px solid #4b5563;">
                                    </a>
                                    @else
                                    <span class="text-gray-600 text-xs">N/A</span>
                                    @endif
                                </td>

                                <td style="padding: 12px;">
                                    @if($user->verified)
                                    <span style="background: #064e3b; color: #6ee7b7; padding: 2px 8px; border-radius: 4px; font-size: 12px; border: 1px solid #059669;">Verified</span>
                                    @else
                                    <span style="background: #78350f; color: #fcd34d; padding: 2px 8px; border-radius: 4px; font-size: 12px; border: 1px solid #d97706;">Pending</span>
                                    @endif
                                </td>

                                <td style="padding: 12px; text-align: right;">
                                    <form method="POST" action="{{ route('admin.delete', $user) }}" onsubmit="return confirm('Are you sure you want to PERMANENTLY delete this user account? This cannot be undone.');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                style="background-color: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; font-weight: bold; font-size: 12px; border: none; cursor: pointer;"
                                                class="hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
