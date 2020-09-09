<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class ActorViewModel extends ViewModel
{
    public $detailsActor;
    public $socialMedia;
    public $credits;

    public function __construct($detailsActor, $socialMedia, $credits)
    {
        $this->detailsActor = $detailsActor;
        $this->socialMedia = $socialMedia;
        $this->credits = $credits;
    }

    public function detailsActor()
    {
        return collect($this->detailsActor)->merge([
            'birthday' => Carbon::parse($this->detailsActor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->detailsActor['birthday'])->age,
            'profile_path' => $this->detailsActor['profile_path'] ?
                'https://image.tmdb.org/t/p/w300/'.$this->detailsActor['profile_path'] :
                'https://ui-avatars.com/api/?size=235&name='.$this->detailsActor['name'],
        ]);
    }

    public function socialMedia()
    {
        return collect($this->socialMedia)->merge([
            'twitter' => $this->socialMedia['twitter_id'] != "" ? 'https://twitter.com/'.$this->socialMedia['twitter_id'] : null,
            'facebook' => $this->socialMedia['facebook_id'] != ""  ? 'https://facebook.com/'.$this->socialMedia['facebook_id'] : null,
            'instagram' => $this->socialMedia['instagram_id'] != ""  ? 'https://instagram.com/'.$this->socialMedia['instagram_id'] : null,
        ]);
    }

    public function knowForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->sortByDesc('popularity')->take(5)->map(function($movie){

            if(isset($movie['title'])){
                $title = $movie['title'];
            } elseif(isset($movie['name'])){
                $title = $movie['name'];
            }else{
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path'] :
                'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
            ]);
        });
    }

    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie){

                if(isset($movie['release_date'])){
                    $releaseDate = $movie['release_date'];
                }elseif(isset($movie['first_air_date'])){
                    $releaseDate = $movie['first_air_date'];
                }else{
                    $releaseDate = '';
                }

                if(isset($movie['title'])){
                    $title = $movie['title'];
                } elseif(isset($movie['name'])){
                    $title = $movie['name'];
                }else{
                    $title = 'Untitled';
                }

                return collect($movie)->merge([
                    'release_date' => $releaseDate,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => $title,
                    'character' => $movie['character'] != "" ? $movie['character'] : 'Not defined',
                ])->sortByDesc('release_date');
            });
    }
}
