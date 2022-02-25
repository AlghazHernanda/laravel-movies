<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors()
    {
        return collect($this->popularActors)->map(function ($actor) {

            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name') //agar tv nya bisa masuk juga bukan cuma movies
                )->implode(', '),

                // only agar yang tampil di api nya saat kita dump hanya yg kita pilih di bawah ini
            ])->only([
                'name', 'id', 'profile_path', 'known_for',
            ]);

            //->dump(); untuk vardump
        });
    }

    public function previous()
    {
        return $this->page > 1
            ? $this->page - 1
            : null;
    }

    public function next()
    {
        return $this->page < 500
            ? $this->page + 1
            : null;
    }
}
