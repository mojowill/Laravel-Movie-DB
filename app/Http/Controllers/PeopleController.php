<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\PeopleViewModel;
use App\ViewModels\PersonViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PeopleController extends Controller
{
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularPeople = Cache::remember('people.page.' . $page, 3600, function () use ($page) {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/popular?page=' . $page)->json()['results'];
        });

        $viewModel = new PeopleViewModel($popularPeople, $page);

        return view('people.index', $viewModel);
    }

    public function show($id)
    {
        $person = Cache::remember('person.' . $id, 3600, function () use ($id) {
            return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id)->json();
        });

        $social = Cache::remember('person.social.' . $id, 3600, function () use ($id) {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
            ->json();
        });

        $credits = Cache::remember('person.credits.' . $id, 3600, function () use ($id) {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
            ->json();
        });

        $viewModel = new PersonViewModel($person, $social, $credits);

        return view('people.show', $viewModel);
    }
}
