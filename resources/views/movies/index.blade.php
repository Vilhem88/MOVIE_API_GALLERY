@extends('layouts/main')


@section('content')
   

    <div class="container mx-auto px-4 pt-16">
         {{-- NOW PLAYING --}}
         <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Now Playing </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-8">
                @foreach ($nowPlaying as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach
            </div>
        </div>
 {{-- Top RATED MOVIES --}}
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Top Rated</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-8">

                @foreach ($topRated as $movie)
                <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>
       
    </div>
@endsection
