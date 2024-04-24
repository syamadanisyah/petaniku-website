<?php

namespace App\Http\Controllers\Mobile\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;


class ProdukController extends Controller
{   
    public function index()
    {
        $produk = Produk::all(); // Mengambil semua data produk dari tabel "produk"
        return response()->json($produk);
    }
    public function kategori(Request $request){
        $kategori = Produk::select('id_produk', 'nama_produk', 'harga')->join('kategori', 'produk.id_kategori' ,'kategori.id_kategori')->where('nama_kategori', $request->input('kategori'))->get();
        return response()->json(['status' => 'success', 'data' => $kategori]);
    }


}
