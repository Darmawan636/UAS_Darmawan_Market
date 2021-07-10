<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['nama_supplier','no_telp','alamat'];
}
