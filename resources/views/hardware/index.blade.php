<x-layout>
    <x-slot:title>Beschikbare Hardware</x-slot:title>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Beschikbare Hardware</h1>
        <p class="text-gray-600">Bekijk welke hardware beschikbaar is om te lenen.</p>
    </div>

    {{-- Zoek- en filterbalk --}}
    <form method="GET" action="{{ route('hardware.index') }}" class="mb-8 flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Zoek op naam, merk of categorie..."
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>
        <div>
            <select name="category"
                class="w-full sm:w-auto rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Alle categorieën</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Zoeken
            </button>
            @if (request('search') || request('category'))
                <a href="{{ route('hardware.index') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Resultaten --}}
    @if ($items->isEmpty())
        <div class="text-center py-16">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 2a10 10 0 110 20 10 10 0 010-20z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Geen items gevonden</h3>
            <p class="mt-1 text-gray-500">Probeer een andere zoekopdracht of filter.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
                <a href="{{ route('hardware.show', $item) }}"
                    class="block bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-blue-300 transition p-6 group">
                    <div class="flex items-start justify-between mb-3">
                        <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">
                            {{ $item->name }}
                        </h2>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Beschikbaar
                        </span>
                    </div>

                    @if ($item->category)
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded mb-3">
                            {{ $item->category }}
                        </span>
                    @endif

                    @if ($item->description)
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $item->description }}</p>
                    @endif

                    <div class="text-sm text-gray-500 space-y-1">
                        @if ($item->brand)
                            <p><span class="font-medium">Merk:</span> {{ $item->brand }}</p>
                        @endif
                        @if ($item->model)
                            <p><span class="font-medium">Model:</span> {{ $item->model }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Paginering --}}
        <div class="mt-8">
            {{ $items->withQueryString()->links() }}
        </div>
    @endif
</x-layout>