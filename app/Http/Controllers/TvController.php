<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvShows = Http::get('https://api.themoviedb.org/3/tv/popular', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['results'];

        $tvHot = Http::get('https://api.themoviedb.org/3/tv/top_rated', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['results'];

        $genres = Http::get('https://api.themoviedb.org/3/genre/tv/list', [
            'api_key' => config('services.tmdb.token'),
        ])->json()['genres'];


        $viewModel = new TvViewModel(
            $tvShows,
            $tvHot,
            $genres
        );

        return view('tv.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tvShow = Http::get('https://api.themoviedb.org/3/tv/'.$id, [
            'api_key' => config('services.tmdb.token'),
            'append_to_response' => 'credits,videos,images'
        ])->json();

        $viewModel = new TvShowViewModel($tvShow);

        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
