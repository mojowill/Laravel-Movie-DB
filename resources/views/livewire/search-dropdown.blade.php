<div class="relative mt-3 md:mt-0" x-data="{ show: true }" @click.away="show = false">
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search (Press '/')" @focus="show = true" x-ref="search" @keydown.escape.window="show = false" @keydown.shift.tab="show = false"
        @keydown="show = true" @keydown.window="if (event.keyCode === 191 ) { event.preventDefault(); $refs.search.focus();}">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>

    <div class="absolute top-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" wire:loading class="text-gray-500 w-4 mt-1 mr-2 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </div>

    @if (strlen($search) >= 2)
        <div class="absolute bg-gray-800 rounded w-64 mt-4 text-sm z-50" x-show="show" x-transition>
            <ul>
                @if ($searchResults->count() > 0)
                    @foreach ($searchResults as $result)
                        <li class="border-gray-700 border-b">
                            <a href="{{ route('movies.show', $result['id']) }}" class="hover:bg-gray-700 px-3 py-3 flex items-center" @if ($loop->last) @keydown.tab="show = false" @endif>
                                @if ($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}" alt="{{ $result['title'] }}" class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="{{ $result['title'] }}" class="w-8">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}
                            </a></span>
                        </li>
                    @endforeach
                @else
                    <div class="px-3 py-3">No results for "{{ $search }}"</div>
                @endif
            </ul>
        </div>
    @endif
</div>
