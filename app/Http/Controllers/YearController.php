<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index()
    {
        // Ambil semua tahun rilis unik dari database
        $years = Movie::select('release_year')->distinct()->orderBy('release_year', 'desc')->pluck('release_year');
        return view('year.index', compact('years'));
    }

    public function show($year)
    {
        // Ambil semua film berdasarkan tahun yang dipilih
        $movies = Movie::where('release_year', $year)->get();

        return view('year.show', compact('year', 'movies'));
    }

}
