<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with(['salesOrder', 'customer'])->get();

        return response()->json([
            'success' => true,
            'data' => $invoice
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_invoice' => 'required|unique:invoice',
            'tanggal_invoice' => 'required|date',
            'no_so' => 'required|exists:sales_order,no_so',
            'kode_customer' => 'required|exists:customer,kode_customer',
            'subtotal' => 'required|numeric',
            'pajak' => 'sometimes|numeric',
            'diskon' => 'sometimes|numeric',
            'total' => 'required|numeric',
            'status_pembayaran' => 'required|in:pending,paid,partial,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $invoice = Invoice::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Invoice berhasil dibuat',
            'data' => $invoice->load(['salesOrder', 'customer'])
        ], 201);
    }

    public function show($id)
    {
        $invoice = Invoice::with(['salesOrder', 'customer'])->find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $invoice
        ]);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal_invoice' => 'required|date',
            'no_so' => 'required|exists:sales_order,no_so',
            'kode_customer' => 'required|exists:customer,kode_customer',
            'subtotal' => 'required|numeric',
            'pajak' => 'sometimes|numeric',
            'diskon' => 'sometimes|numeric',
            'total' => 'required|numeric',
            'status_pembayaran' => 'required|in:pending,paid,partial,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $invoice->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Invoice berhasil diupdate',
            'data' => $invoice->load(['salesOrder', 'customer'])
        ]);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan'
            ], 404);
        }

        $invoice->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invoice berhasil dihapus'
        ]);
    }
}