<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key={{your_key}}')
            ->json()['genres'];

        $nowPlaying = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key={{your_key}}')
            ->json()['results'];
        // dump($nowPlaying);

        $topRated = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key={{your_key}}')
            ->json()['results'];
        // dd($TopRated);

        $viewModel = new MoviesViewModel(
            $genres,
            $nowPlaying,
            $topRated
        );


        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $movie = Http::get('https://api.themoviedb.org/3/movie/' . $id . '?api_key={{your_key}}&append_to_response=credits,videos,images')
            ->json();

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }

   
}
