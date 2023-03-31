<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $socialMedia;
    public $combinedCredits;
    public function __construct($actor, $socialMedia, $combinedCredits)
    {
        $this->actor = $actor;
        $this->socialMedia = $socialMedia;
        $this->combinedCredits = $combinedCredits;
    }

    public function actor()
    {

        return collect($this->actor)->merge([

            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? "https://image.tmdb.org/t/p/w300" .  $this->actor['profile_path']
                : "https://ui-avatars.com/api/?background=random&size=300&name=" . $this->actor['name'],
            'homepage' => $this->actor['homepage']
                ? $this->actor['homepage']
                : null


        ]);
    }

    public function socialMedia()
    {
        return collect($this->socialMedia)->merge([
            'facebook_id' => $this->socialMedia['facebook_id']
                ? 'https://www.facebook.com/' . $this->socialMedia['facebook_id']
                : null,
            'instagram_id' => $this->socialMedia['facebook_id']
                ? 'https://www.instagram.com/' . $this->socialMedia['instagram_id']
                : null,
            'twitter_id' => $this->socialMedia['twitter_id']
                ? 'https://www.twitter.com/' . $this->socialMedia['twitter_id']
                : null
        ]);
    }

    public function knownFor()
    {
        $castTitles = collect($this->combinedCredits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)->map(function ($movie) {
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = '';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? "https://image.tmdb.org/t/p/w185" . $movie['poster_path']
                    : "https://via.placeholder.com/185x278",
                'title' => $title,
                'linkToPage' => $movie['media_type'] == 'movie' 
                ? route('movies.show', $movie['id'])
                : route('tvShows.show', $movie['id'])
                 

            ]);
        });
    }


    public function credits()
    {
        $castTitles = collect($this->combinedCredits)->get('cast');

        return collect($castTitles)->map(function ($movie) {

            if (isset($movie['release_date'])) {
                $release_date = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $release_date = $movie['first_air_date'];
            } else {
                $release_date = '';
            }
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = '';
            }

            return collect($movie)->merge([
                'release_date' => $release_date,
                'release_year' => isset($release_date) ? Carbon::parse($release_date)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : ''
            ]);
        })->sortByDesc('release_date')->take(10);
    }
}
