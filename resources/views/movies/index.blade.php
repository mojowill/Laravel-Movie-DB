<x-main>
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-movies">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Popular Movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end pouplar-movies -->

        <div class="py-12 now-playing-movies">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Now Playing</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end now-playing-movies -->

        <div class="py-12 top-rated-movies">
            <h2 class="text-lg font-semibold tracking-wider text-yellow-500 uppercase">Top Rated Movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($topRated as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end top-rated-movies -->
    </div>
</x-main>
