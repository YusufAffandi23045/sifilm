<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        // Mengambil 4 data film per halaman
        $movies = Movie::paginate(5);

        // Ambil 5 film acak khusus untuk carousel (jika diperlukan)
        $posterMovies = Movie::inRandomOrder()->take(5)->get();

        return view('index', compact('movies', 'posterMovies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('show', compact('movie'));
    }
    public function search(Request $request)
    {
        $query = $request->input('q');

        $movies = Movie::where('title', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('search_results', compact('movies', 'query'));
    }
}