@extends('layouts/main')

@section('content')
    {{-- ----------------- TV INFO ------------------------------------------ --}}
    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img class="hover:opacity-75 transition ease-in-out duration-150"
                src="{{ $tvShow['poster_path'] }}" alt="">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold"> {{ $tvShow['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 mt-1">
                    <span><svg class="fill-current text-orange-400 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </span>
                    <span class="ml-1"> {{ $tvShow['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span class="mx-2">{{$tvShow['first_air_date']}}</span>
                </div>

                <p class="text-gray-400 mt-8">{{ $tvShow['overview'] }}</p>

                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($tvShow['created_by'] as $crew)
                                <div class="mr-8">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">Creator</div>
                                </div>
                    @endforeach

                </div>
            </div>
            <div x-data="{ isOpen: false }">
                @if (count($tvShow['videos']['results']) > 0)
                    <div class="mt-12">
                        <button @click="isOpen = true"
                            class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                            <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                            </svg>
                            <span class="ml-2">Play Trailer</span>
                        </button>
                    </div>

                    <template x-if="isOpen">
                        <div style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                            class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative"
                                            style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                @endif
            </div>
        </div>
    </div>

    {{-- ----------------- CAST ------------------------------------------ --}}

    <div class="tv-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-8">
                @foreach ($tvShow['cast'] as $cast)  
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id']) }}">
                                <img class="hover:opacity-75 transition ease-in-out duration-150"
                                    src="https://image.tmdb.org/t/p/w300/{{ $cast['profile_path'] }}" alt="">
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg hover:text-gray-300 mt-2">{{ $cast['name'] }}</a>
                                <div class="text-sm text-gray-400">
                                    {{ $cast['character'] }}
                                </div>
                            </div>
                        </div>
            @endforeach

        </div>
    </div>
</div>

{{-- ----------------- -IMAGES ------------------------------------------ --}}
<div class="tv-images" x-data="{ isOpen: false, image: '' }">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($tvShow['images'] as $image)
                    <div class="mt-8">
                        <a @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                            "
                            href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}"
                                alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
        @endforeach
    </div>

    <div style="background-color: rgba(0, 0, 0, .5);"
        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
            <div class="bg-gray-900 rounded">
                <div class="flex justify-end pr-4 pt-2">
                    <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                        class="text-3xl leading-none hover:text-gray-300">&times;
                    </button>
                </div>
                <div class="modal-body px-8 py-8">
                    <img :src="image" alt="poster">
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
@endsection
