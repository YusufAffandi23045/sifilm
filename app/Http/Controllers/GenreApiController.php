<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreApiController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all());
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:genres']);
        $genre = Genre::create(['name' => $request->name]);
        return response()->json(['message' => 'Genre berhasil ditambahkan!', 'data' => $genre], 201);
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json($genre);
    }
    
    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id,
        ]);
        $genre->update(['name' => $request->name]);
        return response()->json(['message' => 'Genre berhasil diperbarui!', 'data' => $genre]);
    }
    
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return response()->json(['message' => 'Genre berhasil dihapus']);
    }
}
