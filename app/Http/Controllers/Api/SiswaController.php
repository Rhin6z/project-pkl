<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SiswaController extends Controller
{
    public function index(): JsonResponse
    {
        $siswas = Siswa::with('pkls')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswas
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswas,email',
            'status_lapor_pkl' => 'required|boolean'
        ]);

        $siswa = Siswa::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil disimpan',
            'data' => $siswa
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $siswa = Siswa::with('pkls')->find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data siswa',
            'data' => $siswa
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'nis' => 'sometimes|string|unique:siswas,nis,' . $id,
            'gender' => 'sometimes|in:L,P',
            'alamat' => 'sometimes|string',
            'kontak' => 'sometimes|string',
            'email' => 'sometimes|email|unique:siswas,email,' . $id,
            'status_lapor_pkl' => 'sometimes|boolean'
        ]);

        $siswa->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diupdate',
            'data' => $siswa
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil dihapus'
        ]);
    }
}
