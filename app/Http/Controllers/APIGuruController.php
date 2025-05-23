<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class APIGuruController extends Controller
{
    public function index()
    {
        return Guru::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $guru = Guru::create($validated);
        return response()->json($guru, 201);
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return response()->json($guru);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'nip' => 'string|max:20',
            'alamat' => 'string',
        ]);

        $guru->update($validated);
        return response()->json($guru);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
