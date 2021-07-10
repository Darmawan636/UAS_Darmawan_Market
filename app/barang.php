<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['namabarang','harga','stok','id_supplier'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
        
    }
}
