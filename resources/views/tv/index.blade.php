@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-8 pt-16">
        <div class="popular-tv">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Popular Shows
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($popularTv as $tvshow)
                
                    {{-- mengambil codingan popular tv yang ada di Component/tv-card, 
                    dan kirim data tv dan genre ke situ, jangan lupa ambil variabel nya dulu di app/tvCard --}}
                   <x-tv-card :tvshow="$tvshow"/>
                @endforeach

            </div>
        </div>
    </div>


    <div class="container mx-auto px-8 pt-16">
        <div class="popular-movies">
            <h2 class="text-3xl uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Top Rated Shows
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

                @foreach ($topRatedTv as $tvshow)
                <x-tv-card :tvshow="$tvshow"/>
                @endforeach

            </div>
        </div>
    </div>

   
    
    
    
@endsection