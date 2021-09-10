<x-main>
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-shows">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Popular Shows</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($popularShows as $show)
                    <x-show-card :show="$show" />
                @endforeach
            </div>
        </div> <!-- end pouplar-shows -->

        <div class="pt-12 now-playing-shows">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Now Playing</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($onAir as $show)
                    <x-show-card :show="$show" />
                @endforeach
            </div>
        </div> <!-- end on-air -->

        <div class="py-12 top-rated-shows">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Top Rated Shows</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($topRated as $show)
                    <x-show-card :show="$show" />
                @endforeach
            </div>
        </div> <!-- end on-air -->
    </div>
</x-main>
