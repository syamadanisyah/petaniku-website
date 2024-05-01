<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTotal extends Model
{
    use HasFactory;

    protected $table = 'transaksi_total';
    protected $primaryKey = 'id_tt';

    protected $fillable = ['id_user', 'id_td', 'total_harga',];
}
