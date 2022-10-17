<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;

class MovieController extends Controller
{
    public function index(){
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
        //dump($popularMovies);
        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];
       // dump($popularMovies);
        //dump($nowPlayingMovies);
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
        );
        return view('movies.index',$viewModel,compact('popularMovies','nowPlayingMovies'));
    }

    public function show($id){
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
            ->json();
        //dump($movie);
        return view('movies.show',compact('movie'));
    }
}
