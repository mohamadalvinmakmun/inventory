<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'kode_pegawai';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pegawai',
        'nama_pegawai',
        'bagian',
        'phone',
        'alamat'
    ];
}