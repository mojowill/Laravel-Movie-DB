<x-main>
    <div class="container mx-auto px-4 py-16">
        <div class="popular-people">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular People</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularPeople as $person)
                    <div class="person mt-8">
                        <a href="{{ route('people.show', $person['id']) }}">
                            <img src="{{ $person['profile_path'] }}" alt="profile" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('people.show', $person['id']) }}" class="text-lg hover:text-gray-300">{{ $person['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $person['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-24 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
          </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
        <script>
            let elem = document.querySelector('.grid');
            let infScroll = new InfiniteScroll(elem, {
                // options
                path: '/people/page/@{{#}}',
                append: '.person',
                status: '.page-load-status'
                // history: false,
            });
        </script>
    @endpush
</x-main>
