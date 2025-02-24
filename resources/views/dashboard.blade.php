<x-app-layout>
    <div class="p-6">
        <h2 class="text-lg font-semibold">Welcome, {{ Auth::user()->name }}!</h2>

        <!-- Display Profile Picture -->
        <div class="mt-4">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-32 h-32 rounded-full" alt="Profile Picture">
        </div>

        <p class="mt-2">Role: <strong>{{ Auth::user()->role }}</strong></p>
    </div>
</x-app-layout>
