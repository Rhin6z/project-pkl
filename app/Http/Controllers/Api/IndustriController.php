<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IndustriController extends Controller
{
    public function index(): JsonResponse
    {
        $industris = Industri::with('pkls')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data industri berhasil diambil',
            'data' => $industris
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:industris,email',
            'website' => 'nullable|url'
        ]);

        $industri = Industri::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data industri berhasil disimpan',
            'data' => $industri
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $industri = Industri::with('pkls')->find($id);

        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Data industri tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data industri',
            'data' => $industri
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Data industri tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'bidang_usaha' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'kontak' => 'sometimes|string',
            'email' => 'sometimes|email|unique:industris,email,' . $id,
            'website' => 'nullable|url'
        ]);

        $industri->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data industri berhasil diupdate',
            'data' => $industri
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json([
                'success' => false,
                'message' => 'Data industri tidak ditemukan'
            ], 404);
        }

        $industri->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data industri berhasil dihapus'
        ]);
    }
}
