<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\TransaksiTotal;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function pesananSekarang(Request $request)
    {
        $idUser = $request->input('id_user');
        $totalHarga = $request->input('total_harga');
        $idProduk =  $request->input('id_produk');
        $namaProduk = $request->input('nama_produk');
        $harga =  $request->input('harga');
        $jumlah =  $request->input('jumlah');
    
        // Create a new TransaksiDetail record
        $detail_trans = TransaksiDetail::create([
            'id_produk' => $idProduk,
            'nama_produk' => $namaProduk, // Use $namaProduk instead of $harga for nama_produk
            'jumlah' => $jumlah,
            'harga' => $harga,
        ]);
    
        // Get the ID of the last inserted record
        $lastInsertedId = $detail_trans->id_td;
    
        // You can now use $lastInsertedId as needed
        $total_trans = TransaksiTotal::create([
            'id_user' => $idUser,
            'id_td' => $lastInsertedId, // Use $namaProduk instead of $harga for nama_produk
            'total_harga' => $totalHarga,
        ]);
    
        return response()->json(['status' => 'success', 'message' => 'pesanan berhasil', ], 200);
    }
}
