<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
   public function testMovies(){
       Http::fake([
           'http:://api.themoviedb.org/3/movie/popular'=>Http::response([
             'result' =>'foo'
           ],200),
       ]);
       $response = $this->get(route('movies.index'));
       $response->assertSee('Popular Movies');
   }
}
