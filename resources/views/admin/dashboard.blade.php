<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel - Verify Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Pending Student Verifications</h3>

                @if($users->isEmpty())
                <p class="text-gray-500">No pending verifications.</p>
                @else
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                    <tr class="border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative ">
                        <th class="bg-gray-100 dark:bg-gray-700 p-2 text-gray-900 dark:text-gray-100 font-bold md:border md:border-grey-500 text-left block md:table-cell">Name</th>
                        <th class="bg-gray-100 dark:bg-gray-700 p-2 text-gray-900 dark:text-gray-100 font-bold md:border md:border-grey-500 text-left block md:table-cell">Matric No</th>
                        <th class="bg-gray-100 dark:bg-gray-700 p-2 text-gray-900 dark:text-gray-100 font-bold md:border md:border-grey-500 text-left block md:table-cell">Proof</th>
                        <th class="bg-gray-100 dark:bg-gray-700 p-2 text-gray-900 dark:text-gray-100 font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                    @foreach($users as $user)
                    <tr class="bg-white dark:bg-gray-800 border border-gray-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span>{{ $user->name }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Matric</span>{{ $user->matric_no }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Proof</span>
                            @if($user->matric_card_path)
                            <a href="{{ asset('storage/' . $user->matric_card_path) }}" target="_blank" class="text-blue-600 underline font-bold">View ID Card</a>
                            @else
                            <span class="text-red-500">No Image</span>
                            @endif
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Actions</span>
                            <form action="{{ route('admin.verify', $user) }}" method="POST" class="inline-block">
                                @csrf @method('PATCH')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded border border-green-500">Approve</button>
                            </form>
                            <form action="{{ route('admin.delete', $user) }}" method="POST" class="inline-block ml-2">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded border border-red-500">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
