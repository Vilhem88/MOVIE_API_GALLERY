<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ShowsViewModel extends ViewModel
{
    public $tvShow;
    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }


    public function tvShow(){

        return collect($this->tvShow)->merge([
            'name' => $this->tvShow['name'],
            'created_by' => $this->tvShow['created_by'],
            'poster_path' => "https://image.tmdb.org/t/p/w500" .  $this->tvShow['poster_path'],
            'vote_average' =>  $this->tvShow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
            'crew' => collect($this->tvShow['credits']['crew'])->take(2),
            'cast' => collect($this->tvShow['credits']['cast'])->take(4),
            'images' => collect($this->tvShow['images']['backdrops'])->take(9),
        ]);

    }
}
