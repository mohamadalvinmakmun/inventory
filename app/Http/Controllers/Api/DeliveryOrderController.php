<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $deliveryOrder = DeliveryOrder::with(['salesOrder', 'pegawai'])->get();

        return response()->json([
            'success' => true,
            'data' => $deliveryOrder
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_do' => 'required|unique:delivery_order',
            'tanggal_do' => 'required|date',
            'no_so' => 'required|exists:sales_order,no_so',
            'kode_pegawai' => 'required|exists:pegawai,kode_pegawai',
            'status' => 'sometimes|in:draft,shipped,delivered,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $deliveryOrder = DeliveryOrder::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Delivery Order berhasil dibuat',
            'data' => $deliveryOrder->load(['salesOrder', 'pegawai'])
        ], 201);
    }

    public function show($id)
    {
        $deliveryOrder = DeliveryOrder::with(['salesOrder', 'pegawai'])->find($id);

        if (!$deliveryOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery Order tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $deliveryOrder
        ]);
    }

    public function update(Request $request, $id)
    {
        $deliveryOrder = DeliveryOrder::find($id);

        if (!$deliveryOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery Order tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal_do' => 'required|date',
            'no_so' => 'required|exists:sales_order,no_so',
            'kode_pegawai' => 'required|exists:pegawai,kode_pegawai',
            'status' => 'sometimes|in:draft,shipped,delivered,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $deliveryOrder->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Delivery Order berhasil diupdate',
            'data' => $deliveryOrder->load(['salesOrder', 'pegawai'])
        ]);
    }

    public function destroy($id)
    {
        $deliveryOrder = DeliveryOrder::find($id);

        if (!$deliveryOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery Order tidak ditemukan'
            ], 404);
        }

        $deliveryOrder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delivery Order berhasil dihapus'
        ]);
    }
}