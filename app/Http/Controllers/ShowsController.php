<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ShowViewModel;
use App\ViewModels\ShowsViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShowsController extends Controller
{
    public function index()
    {
        $popularShows = Cache::remember('popularShows', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular')->json()['results'];
        });

        $onAir = Cache::remember('onAirShows', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/on_the_air')->json()['results'];
        });

        $topRated = Cache::remember('topRatedShows', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];
        });

        $genres = Cache::remember('showsGenresArray', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'];
        });

        $viewModel = new ShowsViewModel($popularShows, $onAir, $topRated, $genres);

        return view('shows.index', $viewModel);
    }

    public function show($id)
    {
        $show = Cache::remember('show.' . $id, 3600, function () use ($id) {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')->json();
        });

        $viewModel = new ShowViewModel($show);

        return view('shows.show', $viewModel);
    }
}
