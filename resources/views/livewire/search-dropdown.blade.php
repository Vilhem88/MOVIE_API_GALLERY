<div class="flex flex-col md:flex-row items-center">
    <div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
        <input 
        @keyup.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false" 
        @keydown="isOpen = true" 
        wire:model.debounce.450ms='search'
            type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 py-1 pl-8" placeholder="Search">
        <div class="absolute top-0">
            <svg class="text-gray-500 w-4 mt-2 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
        @if (strlen($search) > 2)
            <div class="z-50 absolute rounded text-sm bg-gray-800 w-64 mt-5" x-show.transition.opacity="isOpen">
                @if ($searchResults->count() > 0)
                    <ul>
                        @foreach ($searchResults as $result)
                            {{-- {{ dd($result) }} --}}
                            <li class="border-b border-gray-700">
                                <a href="{{ route('movies.show', $result['id']) }}"
                                    class="hover:bg-gray-700 px-3 py-3 flex items-center"
                                    @if ($loop->last) @keydown.tab="isOpen = event.shiftKey ? true : false" @endif>
                                    @if ($result['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
                                            alt="poster" class="w-10">
                                        <span class="ml-4">{{ $result['title'] }}</span>
                                    @else
                                        <img src="http://via.placeholder.com/50x75" class="w-10" alt="poster">
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-3 py-3">No such results for {{ $search }}</div>
                @endif
            </div>
        @endif
    </div>
</div>
