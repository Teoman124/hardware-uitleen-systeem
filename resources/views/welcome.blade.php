<x-layout>
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Hardware Uitleen Systeem</h1>
        <p class="text-lg text-gray-600 mb-8">Bekijk en leen beschikbare hardware binnen de organisatie.</p>
        <a href="{{ route('hardware.index') }}"
            class="inline-flex items-center bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium text-lg">
            Bekijk beschikbare hardware
        </a>
    </div>
</x-layout>