<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GuruController extends Controller
{
    public function index(): JsonResponse
    {
        $gurus = Guru::with('pkls')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diambil',
            'data' => $gurus
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|unique:gurus,email'
        ]);

        $guru = Guru::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil disimpan',
            'data' => $guru
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $guru = Guru::with('pkls')->find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data guru',
            'data' => $guru
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'nip' => 'sometimes|string|unique:gurus,nip,' . $id,
            'gender' => 'sometimes|in:L,P',
            'email' => 'sometimes|email|unique:gurus,email,' . $id
        ]);

        $guru->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $guru->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil dihapus'
        ]);
    }
}
