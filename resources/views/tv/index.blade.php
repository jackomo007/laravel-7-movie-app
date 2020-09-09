@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="tv-shows">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">
                Highlighted Shows
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($tvShows  as $tvShow)
                    <x-tv-card :tvShow="$tvShow"/>
                @endforeach
            </div>
        </div>

        <div class="hot-shows py-24">
            <h2 class="uppercase tracking-wider text-gray-500 text-lg font-semibold">
                Everybody is watching now!
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($tvHot  as $tvShow)
                    <x-tv-card :tvShow="$tvShow"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
