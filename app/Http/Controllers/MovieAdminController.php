<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;

class MovieAdminController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.index', compact('movies'));
    }
    public function create()
    {
        $categories = Category::all();
        $genres = Genre::all();
        return view('admin.create', compact('categories', 'genres'));
    }

    public function store(Request $request)
        {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'rating' => 'required|numeric',
            'durasi' => 'required|integer',
            'pemeran' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : 'images/default.jpg';

        $movie = Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_year' => $validated['release_year'],
            'rating' => $validated['rating'],
            'durasi' => $validated['durasi'],
            'pemeran' => $validated['pemeran'],
            'image' => $path ? 'storage/'.$path : null,
        ]);

        if (!empty($validated['genres'])) {
            $movie->genres()->sync($validated['genres']);
        }

        return redirect('/admin')->with('success', 'Film berhasil ditambahkan!');
    }    
    
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.show', compact('movie'));
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        $selectedGenres = $movie->genres->pluck('id')->toArray();

        return view('admin.edit', compact('movie', 'genres', 'selectedGenres'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'rating' => 'required|numeric',
            'durasi' => 'required|integer',
            'pemeran' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        if ($request->hasFile('image')) {
            if ($movie->image && \Storage::disk('public')->exists(str_replace('storage/', '', $movie->image))) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $movie->image));
            }

            $validated['image'] = 'storage/' . $request->file('image')->store('images', 'public');
        }

        $movie->update($validated);

        $movie->genres()->sync($validated['genres'] ?? []);

        return redirect('/admin')->with('success', 'Film berhasil diperbarui!');
    }


    public function destroy($id)
    {
        Movie::destroy($id);
        return redirect('/admin')->with('success', 'Film berhasil dihapus!');
    }
}
