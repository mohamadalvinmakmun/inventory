<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $table = 'delivery_order';
    protected $primaryKey = 'no_do';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_do',
        'tanggal_do',
        'no_so',
        'kode_pegawai',
        'keterangan',
        'status'
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'no_so', 'no_so');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'kode_pegawai', 'kode_pegawai');
    }
}