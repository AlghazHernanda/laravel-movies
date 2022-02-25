<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;
    public $topRatedMovies;
    public $upcomingMovies;

    public function __construct($popularMovies, $nowPlayingMovies, $genres, $topRatedMovies, $upcomingMovies)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
        $this->topRatedMovies = $topRatedMovies;
        $this->upcomingMovies = $upcomingMovies;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    public function topRatedMovies()
    {
        return $this->formatMovies($this->topRatedMovies);
    }
    public function upcomingMovies()
    {
        return $this->formatMovies($this->upcomingMovies);
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'],
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
                // 'production_companies' => $movie['production_companies'],
                // 'production_companies_corporate' => $movie['production_companies'][0]['name'],

                // only agar yang tampil di api nya saat kita dump hanya yg kita pilih di bawah ini
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'production_companies',
                'production_companies_corporate'


            ]);
        });
    }
}
