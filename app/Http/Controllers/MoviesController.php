<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['results'];

        $nowPlayingMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['results'];

        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['genres'];


        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres
        );

        return view('movies.index', $viewModel);
    }

    public function show($id)
    {
        $detailsMovie = Http::get('https://api.themoviedb.org/3/movie/'.$id, [
            'api_key' => config('services.tmdb.token'),
            'append_to_response' => 'credits,videos,images'
        ])->json();

        $viewModel = new MovieViewModel($detailsMovie);

        return view('movies.show', $viewModel);
    }
}
