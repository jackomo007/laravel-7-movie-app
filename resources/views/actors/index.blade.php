@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="famous-people">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">
                Actors
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{route('actors.show', $actor['id'])}}">
                            <img src="{{$actor['profile_path']}}" alt="profile" class="hover:opacity-75 trasition ease-in-out duration-150" style="border-radius: 50% 50% 50% 50% / 10% 10% 90% 90%;">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show', $actor['id'])}}" class="text-lg hover:text-gray-300">{{$actor['name']}}</a>
                            <div class="text-sm truncate text-gray-400">{{$actor['known_for']}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="page-load-status">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
        {{-- <div class="flex justify-between mt-16">
            @if($previous)
                <a href="/actors/page/{{$previous}}">Previous</a>
            @endif
            @if($next)
                <a href="/actors/page/{{$next}}">Next</a>
            @endif
        </div> --}}
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status',
            // history: false,
        });
    </script>
@endsection
