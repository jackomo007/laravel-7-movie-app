<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvViewModel extends ViewModel
{
    public $tvShows;
    public $tvHot;
    public $genres;

    public function __construct($tvShows, $tvHot, $genres)
    {
        $this->tvShows = $tvShows;
        $this->tvHot = $tvHot;
        $this->genres = $genres;
    }

    public function tvShows()
    {
        return $this->formatTv($this->tvShows);
    }

    public function tvHot()
    {
        return $this->formatTv($this->tvHot);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        return collect($tv)->map(function($tvShow) {

            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
