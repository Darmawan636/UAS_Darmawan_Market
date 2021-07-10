<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_barang','id_pembeli','tanggal','keterangan'];

     public function Barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
        
    }

     public function Pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
        
    }
}
