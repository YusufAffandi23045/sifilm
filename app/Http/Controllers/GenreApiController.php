<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Genre",
 *     description="Manajemen Genre (CRUD) - akses terbatas admin login"
 * )
 *
 */

class GenreApiController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/admin/genre",
     *     summary="Ambil semua genre",
     *     tags={"Genre"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar semua genre"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Genre::all());
    }

    /**
     * @OA\Post(
     *     path="/api/admin/genre",
     *     summary="Tambah genre baru",
     *     tags={"Genre"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Action")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Genre berhasil ditambahkan"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:genres']);
        $genre = Genre::create(['name' => $request->name]);
        return response()->json(['message' => 'Genre berhasil ditambahkan!', 'data' => $genre], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/admin/genre{id}",
     *     summary="Tampilkan detail genre",
     *     tags={"Genre"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail genre"
     *     )
     * )
     */

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json($genre);
    }

    /**
     * @OA\Put(
     *     path="/api/admin/genre{id}",
     *     summary="Perbarui genre",
     *     tags={"Genre"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Drama")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Genre berhasil diperbarui"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id,
        ]);
        $genre->update(['name' => $request->name]);
        return response()->json(['message' => 'Genre berhasil diperbarui!', 'data' => $genre]);
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/genre{id}",
     *     summary="Hapus genre",
     *     tags={"Genre"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Genre berhasil dihapus"
     *     )
     * )
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return response()->json(['message' => 'Genre berhasil dihapus']);
    }
}
