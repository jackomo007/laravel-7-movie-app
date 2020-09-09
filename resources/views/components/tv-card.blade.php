<div class="mt-8">
    <a href="{{ route('tv.show', $tvShow['id'])}}">
    <img src="{{ $tvShow['poster_path']}}" alt="{{ $tvShow['name']}}" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
    <a href="{{ route('tv.show', $tvShow['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{ $tvShow['name']}}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>
                <img class="w-4 h4" src="https://img.icons8.com/emoji/2x/star-emoji.png" alt="star">
            </span>
            <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
            <span class="mx-2">|</span>
        <span>{{$tvShow['first_air_date']}}</span>
        </div>
        <div class="text-gray-500 text-sm">
            {{ $tvShow['genres']}}
        </div>
    </div>
</div>
