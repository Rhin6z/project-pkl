<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PklController extends Controller
{
    public function index(): JsonResponse
    {
        $pkls = Pkl::with(['guru', 'siswa', 'industri'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Data PKL berhasil diambil',
            'data' => $pkls
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai'
        ]);

        $pkl = Pkl::create($request->all());
        $pkl->load(['guru', 'siswa', 'industri']);

        return response()->json([
            'success' => true,
            'message' => 'Data PKL berhasil disimpan',
            'data' => $pkl
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $pkl = Pkl::with(['guru', 'siswa', 'industri'])->find($id);

        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Data PKL tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data PKL',
            'data' => $pkl
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Data PKL tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'guru_id' => 'sometimes|exists:gurus,id',
            'siswa_id' => 'sometimes|exists:siswas,id',
            'industri_id' => 'sometimes|exists:industris,id',
            'mulai' => 'sometimes|date',
            'selesai' => 'sometimes|date|after:mulai'
        ]);

        $pkl->update($request->all());
        $pkl->load(['guru', 'siswa', 'industri']);

        return response()->json([
            'success' => true,
            'message' => 'Data PKL berhasil diupdate',
            'data' => $pkl
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Data PKL tidak ditemukan'
            ], 404);
        }

        $pkl->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data PKL berhasil dihapus'
        ]);
    }
}
