<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;

use Illuminate\Http\Request;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::get('https://api.themoviedb.org/3/person/popular', [
            'api_key' => config('services.tmdb.token'),
            'page' => $page,
        ])->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);
        return view('actors.index', $viewModel);
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
        $detailsActor = Http::get('https://api.themoviedb.org/3/person/'.$id, [
            'api_key' => config('services.tmdb.token'),
        ])->json();

        $socialMedia = Http::get('https://api.themoviedb.org/3/person/'.$id.'/external_ids', [
            'api_key' => config('services.tmdb.token'),
        ])->json();

        $credits = Http::get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits', [
            'api_key' => config('services.tmdb.token'),
        ])->json();

        $viewModel = new ActorViewModel($detailsActor, $socialMedia, $credits);

        return view('actors.show', $viewModel);
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
