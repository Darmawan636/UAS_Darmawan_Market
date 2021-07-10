<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['tgl_bayar','total_bayar','id_transaksi'];

    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
        
    }
}

