<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public  $popularTv;
    public  $topRatedTv;

    public function __construct($topRatedTv, $popularTv)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
       
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

   



    private function formatTv($tv)
    {
        return collect($tv)->map(function ($tvShow) {
          
            return collect($tvShow)->merge([
                'name' => $tvShow['name'],
                'poster_path' => "https://image.tmdb.org/t/p/w500" . $tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
               
            ]);
        });
    }
}
