<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieAdminApiController extends Controller
{
    public function index()
    {
        return response()->json(Movie::all());
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
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        $validated['image'] = $path;

        $movie = Movie::create($validated);
        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres);
        }
        return response()->json(['message' => 'Film berhasil ditambahkan', 'data' => $movie->load('genres')]);
    }    
    
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
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
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($movie->image && Storage::disk('public')->exists($movie->image)) {
                Storage::disk('public')->delete($movie->image);
            }

            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $movie->update($validated);
        
        $movie->genres()->sync($validated['genres'] ?? []);

        return response()->json(['message' => 'Film berhasil diperbarui', 'data' => $movie]);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['message' => 'Film berhasil dihapus']);
    }
}
