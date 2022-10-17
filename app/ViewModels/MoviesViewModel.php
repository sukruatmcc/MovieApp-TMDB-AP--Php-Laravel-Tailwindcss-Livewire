<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public function __construct($popularMovies,$nowPlayingMovies)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
    }

    public function popularMovies(){
        return $this->popularMovies;
    }

    public function nowPlayingMovies(){
        return $this->nowPlayingMovies;
    }
}
