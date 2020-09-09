<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MovieViewModel extends ViewModel
{
    public $detailsMovie;

    public function __construct($detailsMovie)
    {
        $this->detailsMovie = $detailsMovie;
    }

    public function detailsMovie()
    {
        return collect($this->detailsMovie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->detailsMovie['poster_path'],
            'vote_average' => $this->detailsMovie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->detailsMovie['release_date'])->format('M d, Y'),
            'genres' => collect($this->detailsMovie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->detailsMovie['credits']['crew'])->take(2),
            'cast' => collect($this->detailsMovie['credits']['cast'])->take(10),
            'images' => collect($this->detailsMovie['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'credits', 'videos', 'images', 'crew', 'cast'
        ]);
    }
}
