<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    public function index()
    {
        $salesOrder = SalesOrder::with(['customer', 'pegawai'])->get();

        return response()->json([
            'success' => true,
            'data' => $salesOrder
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_so' => 'required|unique:sales_order',
            'tanggal_so' => 'required|date',
            'kode_customer' => 'required|exists:customer,kode_customer',
            'kode_pegawai' => 'required|exists:pegawai,kode_pegawai',
            'total' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $salesOrder = SalesOrder::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Sales Order berhasil dibuat',
            'data' => $salesOrder->load(['customer', 'pegawai'])
        ], 201);
    }

    public function show($id)
    {
        $salesOrder = SalesOrder::with(['customer', 'pegawai'])->find($id);

        if (!$salesOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Sales Order tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $salesOrder
        ]);
    }

    public function update(Request $request, $id)
    {
        $salesOrder = SalesOrder::find($id);

        if (!$salesOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Sales Order tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal_so' => 'required|date',
            'kode_customer' => 'required|exists:customer,kode_customer',
            'kode_pegawai' => 'required|exists:pegawai,kode_pegawai',
            'total' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $salesOrder->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Sales Order berhasil diupdate',
            'data' => $salesOrder->load(['customer', 'pegawai'])
        ]);
    }

    public function destroy($id)
    {
        $salesOrder = SalesOrder::find($id);

        if (!$salesOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Sales Order tidak ditemukan'
            ], 404);
        }

        $salesOrder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sales Order berhasil dihapus'
        ]);
    }
}