<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'no_invoice';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_invoice',
        'tanggal_invoice',
        'no_so',
        'kode_customer',
        'subtotal',
        'pajak',
        'diskon',
        'total',
        'status_pembayaran',
        'tanggal_jatuh_tempo'
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'no_so', 'no_so');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer', 'kode_customer');
    }
}