<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ShowsViewModel;
use App\ViewModels\TvShowsViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $popularTv = Http::get('https://api.themoviedb.org/3/tv/popular?api_key={{your_key}}')
            ->json()['results'];
        // dump($nowPlaying);

        $topRatedTv = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key={{your_key}}')
            ->json()['results'];
        // dd($TopRated);

        $viewModel = new TvShowsViewModel(
            $popularTv,
            $topRatedTv
        );

        return view('tvShows.index',  $viewModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tvShow = Http::get('https://api.themoviedb.org/3/tv/' . $id . '?api_key={{your_key}}&append_to_response=credits,videos,images')
            ->json();

        $viewModel = new ShowsViewModel($tvShow);

        return view('tvShows.show', $viewModel);
    }

}
