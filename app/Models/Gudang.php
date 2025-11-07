<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_gudang',
        'nama_gudang'
    ];
}