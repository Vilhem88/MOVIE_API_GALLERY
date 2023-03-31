<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{

    public $genres;
    public $nowPlaying;
    public $topRated;

    public function __construct($genres, $nowPlaying, $topRated)
    {
        $this->genres = $genres;
        $this->nowPlaying = $nowPlaying;
        $this->topRated = $topRated;
    }

   
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    public function nowPlaying()
    {
        return $this->formatMovies($this->nowPlaying);
    }

    public function topRated()
    {
        return $this->formatMovies($this->topRated);
    }

    // Private Methods --------- ///

    private function formatMovies($movies)
    {
        return collect($movies)->map(function ($movie) {

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500" . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
