<x-layout>
    <x-slot:title>Uitleenverzoek - {{ $hardwareItem->name }}</x-slot:title>

    {{-- Terug-link --}}
    <div class="mb-6">
        <a href="{{ route('hardware.show', $hardwareItem) }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Terug naar {{ $hardwareItem->name }}
        </a>
    </div>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Uitleenverzoek indienen</h1>
            <p class="text-gray-600 mb-6">Vul onderstaand formulier in om <strong>{{ $hardwareItem->name }}</strong> aan
                te vragen.</p>

            {{-- Item samenvatting --}}
            <div class="bg-gray-50 rounded-lg p-4 mb-6 flex items-start gap-4">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $hardwareItem->name }}</h3>
                    <p class="text-sm text-gray-500">
                        @if ($hardwareItem->brand) {{ $hardwareItem->brand }} @endif
                        @if ($hardwareItem->model) &middot; {{ $hardwareItem->model }} @endif
                    </p>
                    @if ($hardwareItem->category)
                        <span class="inline-block mt-1 bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded">
                            {{ $hardwareItem->category }}
                        </span>
                    @endif
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('loans.store', $hardwareItem) }}" class="space-y-4">
                @csrf

                <div>
                    <label for="expected_return_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Verwachte retourdatum
                    </label>
                    <input type="date" name="expected_return_date" id="expected_return_date"
                        value="{{ old('expected_return_date') }}" min="{{ now()->addDay()->format('Y-m-d') }}" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    <p class="mt-1 text-xs text-gray-500">Kies een datum in de toekomst.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium">
                        Verzoek indienen
                    </button>
                    <a href="{{ route('hardware.show', $hardwareItem) }}"
                        class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition font-medium">
                        Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>