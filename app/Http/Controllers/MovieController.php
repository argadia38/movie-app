<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar semua film.
     */
    public function index()
    {
        // Mengambil semua film, diurutkan dari yang terbaru, dengan pagination
        // with('genres') adalah eager loading untuk menghindari N+1 query problem
        $movies = Movie::latest()->with('genres')->paginate(12);

        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    /**
     * Menampilkan halaman detail untuk satu film.
     */
    public function show(Movie $movie)
    {
        // Laravel secara otomatis akan mencari film berdasarkan slug dari URL
        // dan menyuntikkannya ke dalam variabel $movie
        return view('movies.show', [
            'movie' => $movie,
        ]);
    }
}
