<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;
    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors(){

        return  collect($this->popularActors)->map(function($actor){
            return collect($actor)->merge([

                'profile_path' =>$actor['profile_path']
                 ? "https://image.tmdb.org/t/p/w235_and_h235_face" .  $actor['profile_path']
                 : "https://ui-avatars.com/api/?background=random&size=235&name=". $actor['name'],
                 'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                 )->implode(', '),
            ]);
        });
    }

    public function previous(){
        $page = intval($this->page);
        return $page > 1 ? $page - 1 : null;
    }

    public function next(){
        $page = intval($this->page);
        return $page < 500 ? $page + 1 : null;
        
    }


}
