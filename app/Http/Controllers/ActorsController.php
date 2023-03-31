<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $popularActors = Http::get('https://api.themoviedb.org/3/person/popular?api_key={{your_key}}&page='.$page)
        ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return  view('actors.index', $viewModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $actor = Http::get('https://api.themoviedb.org/3/person/'.$id.'?api_key={{your_key}}')
        ->json();
        $socialMedia = Http::get('https://api.themoviedb.org/3/person/'.$id.'/external_ids?api_key={{your_key}}')
        ->json();
        $combinedCredits = Http::get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits?api_key={{your_key}}')
        ->json();
        $viewModel = new ActorViewModel($actor, $socialMedia, $combinedCredits);

        // dd($actor);
        return view('actors.show', $viewModel);
    }

}
