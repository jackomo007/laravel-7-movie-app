@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="wall-of-fame">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">
                Wall of fame
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularMovies as $popularMovie)
                    <x-movie-card :movie="$popularMovie" :genres="$genres"/>
                @endforeach
            </div>
        </div>

        <div class="watching-movies py-24">
            <h2 class="uppercase tracking-wider text-gray-500 text-lg font-semibold">
                This is hot rigth now!
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($nowPlayingMovies as $nowPlayingMovie)
                    <x-movie-card :movie="$nowPlayingMovie"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
