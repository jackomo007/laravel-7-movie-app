@extends('layouts.main')

@section('content')
    <div class="tv-info border-b boder-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{$tvShow['poster_path']}}" alt="{{ $tvShow['name']}}" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">
                    {{ $tvShow['name']}}
                </h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <span>
                        <img class="w-4 h4" src="https://img.icons8.com/emoji/2x/star-emoji.png" alt="star">
                    </span>
                    <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvShow['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $tvShow['genres'] }}
                    </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{ $tvShow['overview']}}
                </p>
                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($tvShow['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name']}}</div>
                            <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div x-data="{ isOpen: false}">
                    @if(count($tvShow['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="flex inline-flex items-center bg-blue-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-blue-600 transition ease-in-out duration-150">
                                <img class="w-8 h6" src="https://img.icons8.com/color/2x/youtube-play.png" alt="star">
                                <span class="ml-2 text-white">Play Trailer</span>
                            </button>
                        </div>

                        <div
                            style="background-color: rgba(0,0,0,.5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            x-show.transition.opacity="isOpen"
                            >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times</button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe
                                                width="560"
                                                height="315"
                                                class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}"
                                                style="border: 0;"
                                                allow="autoplay; encrypted-media"
                                                allowfullscreen
                                            ></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tv-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tvShow['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{route('actors.show', $cast['id'])}}">
                            <img src="{{ $cast['profile_path']}}" class="rounded-full hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2 flex flex-col items-center">
                            <a href="{{route('actors.show', $cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{$cast['character']}}</a>
                            <div class="text-gray-500 text-sm">
                                {{$cast['name']}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="tv-images" x-data="{isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($tvShow['images'] as $cast)
                    <div class="mt-8">
                        <a
                            @click.prevent="
                                isOpen = true
                                image = '{{'https://image.tmdb.org/t/p/original/'.$cast['file_path']}}'
                            "
                            href="#">
                            <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['file_path']}}" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
            <div
                style="background-color: rgba(0,0,0,.5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                                <button @click="isOpen = false" @keydown.escape.window="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
