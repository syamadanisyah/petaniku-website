<?php

namespace App\Http\Controllers\Mobile\Page;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Illuminate\Http\Request;
use App\Models\Produk;


class ProdukController extends Controller
{   
    //menampilkan semua produk
    public function index()
    {
        $produk = Produk::all(); // Mengambil semua data produk dari tabel "produk"
        return response()->json($produk);
    }
   //menampilkan produk sesuai kategori
    public function kategori(Request $request){
        // $kategori = Produk::select('id_produk', 'nama_produk', 'harga','diskripsi')->join('kategori', 'produk.id_kategori' ,'kategori.id_kategori')->where('produk.id_kategori', $request->input('id_kategori'))->get();
        $kategori  = Produk::select('id_produk', 'nama_produk', 'harga','diskripsi')
       ->where('id_kategori', $request->input('id_kategori'))
       ->get();
        // return response()->json(['status' => 'success', 'data' => $kategori]);
        return response()->json($kategori, 200);
    }

    public function allCategory()
    {
        $produk = kategori::all(); // Mengambil semua data produk dari tabel "produk"
        return response()->json($produk);
    }

}
