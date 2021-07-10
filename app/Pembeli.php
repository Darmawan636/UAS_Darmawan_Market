<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'pembelis';
    protected $primaryKey = 'id_pembeli';
    protected $fillable = ['nama_pembeli','jk','no_telp','alamat'];
}
