<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;

class ActorsController extends Controller
{
    public function index($page = 1){
        abort_if($page>500,204);
        $popularActors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
            ->json()['results'];
        $viewModel = new ActorsViewModel($popularActors,$page);
        return view('actors.index',$viewModel);
    }

    public function show($id){
        $actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id)
            ->json();
        //dump($actor);
        $social = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
            ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);
        return view('actors.show',$viewModel);
    }
}
