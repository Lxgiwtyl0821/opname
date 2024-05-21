<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;
    protected $table = 'transaksi_barang';
    
    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_barang','id');
    }
}
