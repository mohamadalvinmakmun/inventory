<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AkunBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AkunBankController extends Controller
{
    public function index()
    {
        $akunBank = AkunBank::all();

        return response()->json([
            'success' => true,
            'data' => $akunBank
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_akun' => 'required|unique:akun_bank',
            'nama_akun' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $akunBank = AkunBank::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Akun Bank berhasil ditambahkan',
            'data' => $akunBank
        ], 201);
    }

    public function show($id)
    {
        $akunBank = AkunBank::find($id);

        if (!$akunBank) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Bank tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $akunBank
        ]);
    }

    public function update(Request $request, $id)
    {
        $akunBank = AkunBank::find($id);

        if (!$akunBank) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Bank tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_akun' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $akunBank->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Akun Bank berhasil diupdate',
            'data' => $akunBank
        ]);
    }

    public function destroy($id)
    {
        $akunBank = AkunBank::find($id);

        if (!$akunBank) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Bank tidak ditemukan'
            ], 404);
        }

        $akunBank->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun Bank berhasil dihapus'
        ]);
    }
}