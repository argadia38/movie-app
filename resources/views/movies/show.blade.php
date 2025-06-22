@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 md:gap-12">
        <div class="w-full md:w-1/3 flex-shrink-0">
            <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="w-full rounded-lg shadow-2xl shadow-red-500/10">
        </div>
        <div class="w-full md:w-2/3">
            <h1 class="text-4xl lg:text-5xl font-bold mb-2">{{ $movie->title }}</h1>
            <p class="text-xl text-gray-400 mb-4">{{ $movie->release_year }}</p>

            <div class="flex flex-wrap gap-2 mb-8">
                @foreach ($movie->genres as $genre)
                    <span class="bg-gray-700 text-gray-300 text-xs font-semibold px-3 py-1 rounded-full">{{ $genre->name }}</span>
                @endforeach
            </div>

            <h2 class="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4">Sinopsis</h2>
            <div class="text-gray-300 prose prose-invert max-w-none text-justify">{!! $movie->synopsis !!}</div>

            @if ($movie->stream_links)
                <h2 class="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4 mt-8">Tonton Online</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach ($movie->stream_links as $link)
                        <a href="{{ $link['url'] }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            {{ $link['server_name'] }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($movie->download_links)
                <h2 class="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4 mt-8">Link Download</h2>
                <div class="space-y-3">
                    @foreach ($movie->download_links as $link)
                        <div class="bg-gray-800 p-4 rounded-lg flex justify-between items-center hover:bg-gray-700 transition-colors">
                            <div>
                                <span class="font-semibold text-lg">{{ $link['server_name'] }}</span>
                                <span class="text-sm text-gray-400 ml-2">({{ $link['quality'] }})</span>
                            </div>
                            <a href="{{ $link['url'] }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm transition-colors">
                                Download
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
