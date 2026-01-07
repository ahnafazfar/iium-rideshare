<x-app-layout>
    <div class="p-6">
        <a href="/rides/create" class="bg-blue-500 text-white px-4 py-2">Add Ride</a>

        @foreach($rides as $ride)
        <div class="border p-4 mt-4">
            <p><strong>{{ $ride->pickup }}</strong> → {{ $ride->dropoff }}</p>
            <p>Time: {{ $ride->time }}</p>

            <a href="{{ $ride->user->contact_link }}" class="text-blue-600">
                Contact
            </a>

            @if(auth()->id() === $ride->user_id)
            <form method="POST" action="/rides/{{ $ride->id }}">
                @csrf @method('DELETE')
                <button class="text-red-600">Delete</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</x-app-layout>
