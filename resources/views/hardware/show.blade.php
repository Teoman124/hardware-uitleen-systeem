<x-layout>
    <x-slot:title>{{ $hardwareItem->name }}</x-slot:title>

    {{-- Terug-link --}}
    <div class="mb-6">
        <a href="{{ route('hardware.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Terug naar overzicht
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-8">
            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $hardwareItem->name }}</h1>
                    @if ($hardwareItem->category)
                        <span class="inline-block mt-2 bg-gray-100 text-gray-600 text-sm px-3 py-1 rounded-full">
                            {{ $hardwareItem->category }}
                        </span>
                    @endif
                </div>
                <div>
                    @if ($hardwareItem->isAvailable())
                        <span
                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Beschikbaar
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            Niet beschikbaar
                        </span>
                    @endif
                </div>
            </div>

            {{-- Beschrijving --}}
            @if ($hardwareItem->description)
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Beschrijving</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $hardwareItem->description }}</p>
                </div>
            @endif

            {{-- Specificaties --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Specificaties</h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                    @if ($hardwareItem->brand)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Merk</dt>
                            <dd class="mt-1 text-gray-900">{{ $hardwareItem->brand }}</dd>
                        </div>
                    @endif
                    @if ($hardwareItem->model)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Model</dt>
                            <dd class="mt-1 text-gray-900">{{ $hardwareItem->model }}</dd>
                        </div>
                    @endif
                    @if ($hardwareItem->serial_number)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Serienummer</dt>
                            <dd class="mt-1 text-gray-900 font-mono text-sm">{{ $hardwareItem->serial_number }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-gray-900 capitalize">{{ $hardwareItem->status }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Actieknoppen --}}
            @if ($hardwareItem->isAvailable())
                <div class="border-t pt-6">
                    @auth
                        <a href="{{ route('loans.create', $hardwareItem) }}"
                            class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Uitleenverzoek indienen
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                            Log in om een uitleenverzoek in te dienen
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-layout>