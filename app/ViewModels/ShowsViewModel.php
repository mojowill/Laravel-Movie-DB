<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ShowsViewModel extends ViewModel
{
    public $popularShows;

    public $onAir;

    public $topRated;

    public $genres;

    public function __construct($popularShows, $onAir, $topRated, $genres)
    {
        $this->popularShows = $popularShows;
        $this->onAir = $onAir;
        $this->topRated = $topRated;
        $this->genres = $genres;
    }

    public function popularShows()
    {
        return $this->formatShows($this->popularShows);
    }

    public function onAir()
    {
        return $this->formatShows($this->onAir);
    }

    public function topRated()
    {
        return $this->formatShows($this->topRated);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatShows($shows)
    {
        return collect($shows)->map(function ($show) {
            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
