<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'],
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),

            //pluck -> agar saat kita dump api nya, id nya tidak ada, hanya nama aja
            //->flatten -> agar bentuk api nya berubah jadi array
            //implode -> agar data jadi berurutan dan ada koma nya
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),

            'crew' => collect($this->movie['credits']['crew'])->take(4), // {{-- untuk menampilkan 4 crew --}}
            'cast' => collect($this->movie['credits']['cast'])->take(5), // {{-- untuk menampilkan 5 cast --}}
            'images' => collect($this->movie['images']['backdrops'])->take(9), // {{-- untuk menampilkan 4 crew --}}
        ]);
        // ->only([
        //     'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'credits',
        //     'videos', 'images', 'crew', 'cast', 'images'
        // ]);
    }
}
