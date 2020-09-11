@extends('layouts.main')

@section('content')
    <div class="movie-info border-b boder-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{$detailsActor['profile_path']}}" alt="{{$detailsActor['name']}}" class="w-76" style="border-radius: 80px/80px;">
                <ul class="flex items-center justify-around mt-4">
                    @if($socialMedia['facebook'])
                        <li class="ml-6">
                            <a href="{{$socialMedia['facebook']}}" title="Facebook">
                                <img class="w-8 h8" src="https://img.icons8.com/color/2x/facebook-new.png" alt="star">
                            </a>
                        </li>
                    @endif
                    @if($socialMedia['instagram'])
                        <li class="ml-2">
                            <a href="{{$socialMedia['instagram']}}" title="Instagram">
                                <img class="w-8 h8" src="https://img.icons8.com/color/2x/instagram-new.png" alt="star">
                            </a>
                        </li>
                    @endif
                    @if($socialMedia['twitter'])
                        <li class="ml-2">
                            <a href="{{$socialMedia['twitter']}}" title="Twitter">
                                <img class="w-8 h8" src="https://img.icons8.com/color/2x/twitter.png" alt="star">
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl md:mt-0 font-semibold">
                    {{$detailsActor['name']}}
                </h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <span>
                        <img class="w-4 h4" src="https://img.icons8.com/color/2x/calendar.png" alt="star">
                    </span>
                    <span class="ml-2">{{$detailsActor['birthday']}} ({{$detailsActor['age']}} years old) in {{$detailsActor['place_of_birth']}} </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$detailsActor['biography']}}
                </p>

                <h4 class="font-semibold mt-12">Know For:</h4>

                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-5 gap-8">
                    @foreach ($knowForMovies as $movie)
                    <div class="mt-4">
                        <a href="{{$movie['linkToPage']}}">
                            <img src="{{$movie['poster_path']}}" alt="poster" class="hover:opacity-75 transtion ease-in-out duration-150" style="border-radius: 5px 35px 5px;">
                        </a>
                        <a href="{{$movie['linkToPage']}}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{$movie['title']}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach ($credits as $credit)
                    <li>{{$credit['release_year']}} &middot; <strong>{{$credit['title']}}</strong> as {{$credit['character']}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
