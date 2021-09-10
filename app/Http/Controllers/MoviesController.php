<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Cache::remember('popularMovies', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];
        });

        $nowPlayingMovies = Cache::remember('nowPlayingMovies', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];
        });

        $topRated = Cache::remember('topRatedMovies', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/top_rated')->json()['results'];
        });

        $genres = Cache::remember('genresArray', 3600, function () {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
        });

        $viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $topRated, $genres);

        return view('movies.index', $viewModel);
    }

    public function show($id)
    {
        $movie = Cache::remember('movie.' . $id, 3600, function () use ($id) {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')->json();
        });

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }
}
