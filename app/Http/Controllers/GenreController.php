<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {        
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function show($name)
    {
        $genre = Genre::where('name', $name)->firstOrFail();
        $movies = Movie::whereHas('genres', function ($query) use ($genre) {
            $query->where('genre_id', $genre->id);
        })->get();

        return view('genre.show', compact('genre', 'movies'));
    }
}
