<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieApiController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json(['movies' => $movies]);
    }
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
    }
}
