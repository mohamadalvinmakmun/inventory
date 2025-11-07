<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = 'sales_order';
    protected $primaryKey = 'no_so';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_so',
        'tanggal_so',
        'kode_customer',
        'kode_pegawai',
        'keterangan',
        'status',
        'total'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer', 'kode_customer');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'kode_pegawai', 'kode_pegawai');
    }
}