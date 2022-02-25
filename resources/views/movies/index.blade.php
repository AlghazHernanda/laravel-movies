@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-8 pt-16">
        <div class="popular-movies">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Popular Movies
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($popularMovies as $movie)
                
                    {{-- mengambil codingan popular movie yang ada di Component/movie-card, 
                    dan kirim data movie dan genre ke situ, jangan lupa ambil variabel nya dulu di app/MovieCard --}}
                    <x-movie-card :movie="$movie"/>

                @endforeach

            </div>
        </div>
    </div>


    <div class="container mx-auto px-8 pt-16">
        <div class="popular-movies">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Now Playing
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach

            </div>
        </div>
    </div>

    <div class="container mx-auto px-8 pt-16">
        <div class="popular-movies">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Latest Movies
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($upcomingMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach

            </div>
        </div>
    </div>

    <div class="container mx-auto px-8 pt-16">
        <div class="popular-movies">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Top Rated
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($topRatedMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach

            </div>
        </div>
    </div>
    
    
@endsection