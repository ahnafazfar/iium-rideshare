<x-app-layout>
    <form method="POST" action="/rides" class="p-6">
@csrf
        <input name="pickup" placeholder="Pickup" class="block mb-2" required>
        <input name="dropoff" placeholder="Drop-off" class="block mb-2" required>
        <input name="time" placeholder="Time" class="block mb-2" required>
        <button class="bg-green-500 text-white px-4 py-2">Submit</button>
    </form>
</x-app-layout>
