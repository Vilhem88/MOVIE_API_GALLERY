<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component

{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) > 2) {
            $searchResults = Http::get('https://api.themoviedb.org/3/search/movie?api_key=ab902be7c958317194103cf6b62118f3&query=' . $this->search)
                ->json()['results'];
        }

        $searchResults = collect($searchResults)->take(8);

        // dump($searchResults);
        return view('livewire.search-dropdown', compact('searchResults'));
    }
}
