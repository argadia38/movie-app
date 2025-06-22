@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-8">
        @forelse ($movies as $movie)
            <div class="group">
                <a href="{{ route('movies.show', $movie) }}">
                    <div class="aspect-[2/3] w-full overflow-hidden rounded-xl bg-gray-800 shadow-lg">
                        <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                    </div>
                </a>
                <div class="mt-3">
                    <a href="{{ route('movies.show', $movie) }}">
                        <h3 class="text-md font-semibold text-white truncate group-hover:text-red-400 transition-colors">{{ $movie->title }}</h3>
                    </a>
                    <p class="text-xs text-gray-400 mt-1">{{ $movie->release_year }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada film yang ditambahkan.</p>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $movies->links() }}
    </div>
@endsection
