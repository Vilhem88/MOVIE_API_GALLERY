@extends('layouts/main')


@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors py-24">
            <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Popular Actors </h2>
            <div id="wrapper" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $actor['id']) }}"><img src="{{ $actor['profile_path'] }}" alt=""
                                class="hover:opacity-75 transition ease-in-out duration-150"></a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="page-load-status my-8">
          <div class="flex justify-center"> 
            <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
          </div>
          <p class="infinite-scroll-last">End of content</p>
          <p class="infinite-scroll-error">No more pages to load</p>
        </div>
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}">Previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="/actors/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif

        </div> --}}
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script>
    <script>
        let elem = document.querySelector('#wrapper');
        let infScroll = new InfiniteScroll(elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
        });
    </script>
@endsection
