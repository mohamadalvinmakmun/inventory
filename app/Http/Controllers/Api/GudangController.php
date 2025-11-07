<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::all();

        return response()->json([
            'success' => true,
            'data' => $gudang
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_gudang' => 'required|unique:gudang',
            'nama_gudang' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $gudang = Gudang::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Gudang berhasil ditambahkan',
            'data' => $gudang
        ], 201);
    }

    public function show($id)
    {
        $gudang = Gudang::find($id);

        if (!$gudang) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gudang
        ]);
    }

    public function update(Request $request, $id)
    {
        $gudang = Gudang::find($id);

        if (!$gudang) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_gudang' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $gudang->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Gudang berhasil diupdate',
            'data' => $gudang
        ]);
    }

    public function destroy($id)
    {
        $gudang = Gudang::find($id);

        if (!$gudang) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang tidak ditemukan'
            ], 404);
        }

        $gudang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gudang berhasil dihapus'
        ]);
    }
}