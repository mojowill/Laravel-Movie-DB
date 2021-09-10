<x-main>
    <div class="border-b border-gray-800 show-info">
        <div class="container flex flex-col px-4 py-16 mx-auto md:flex-row">
            <div class="flex-none">
                <img src="{{ $show['poster_path'] }}" alt="poster" class="w-64 lg:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="mt-4 mb-1 text-4xl font-semibold md:mt-0">{{ $show['name'] }}</h2>
                <div class="flex flex-wrap items-center text-sm text-gray-400">
                    <svg class="w-4 text-yellow-500 fill-current" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star" />
                        </g>
                    </svg>
                    <span class="ml-1">{{ $show['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['genres'] }}</span>
                </div>

                <p class="mt-8 text-gray-300">
                    {{ $show['overview'] }}
                </p>

                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($show['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ show: false }">
                    @if (count($show['videos']['results']) > 0)
                        <div class="mt-12">
                            <button @click="show = true" class="inline-flex items-center px-5 py-4 font-semibold text-gray-900 transition duration-150 ease-in-out bg-yellow-500 rounded hover:bg-yellow-600" @click.away="show = false">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        <div class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto bg-black shadow-lg bg-opacity-60" x-show="show" x-transition>
                            <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pt-2 pr-4">
                                        <button @click="show = false" @keydown.escape.window="show = false" class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="px-8 py-8 modal-body">
                                        <div class="relative overflow-hidden responsive-container" style="padding-top: 56.25%">
                                            <iframe class="absolute top-0 left-0 w-full h-full responsive-iframe" src="https://www.youtube.com/embed/{{ $show['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div> <!-- end show-info -->

    <div class="border-b border-gray-800 show-cast">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($show['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('people.show', $cast['id']) }}">
                            @if ($cast['profile_path'])
                                <img src="https://image.tmdb.org/t/p/w500{{ $cast['profile_path'] }}" alt="profile" class="transition duration-150 ease-in-out hover:opacity-75">
                            @else
                                <img src="https://via.placeholder.com/500x750" alt="profile" class="transition duration-150 ease-in-out hover:opacity-75">
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('people.show', $cast['id']) }}" class="mt-2 text-lg hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end show-cast -->

    <div class="show-images" x-data="{ show: false, image: ''}">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($show['images'] as $image)
                    <div class="mt-8">
                        <a @click.prevent="
                                    show = true
                                    image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                                " href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" alt="image1" class="transition duration-150 ease-in-out hover:opacity-75">
                        </a>
                    </div>
                @endforeach
            </div>

            <div style="background-color: rgba(0, 0, 0, .5);" class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto shadow-lg" x-show="show">
                <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pt-2 pr-4">
                            <button @click="show = false" @keydown.escape.window="show = false" class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="px-8 py-8 modal-body">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end show-images -->
</x-main>
