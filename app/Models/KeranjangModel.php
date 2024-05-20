<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangModel extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    public $timestamps = false;

    protected $fillable = [
    	'id_produk', 'id_user', 'jumlah_beli'
    ];
}
