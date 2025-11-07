<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'kode_suplier';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_suplier',
        'nama_suplier',
        'alamat',
        'phone',
        'nama_pt',
        'fax'
    ];
}