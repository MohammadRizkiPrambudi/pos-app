<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class BarangApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'harga'       => 'required|integer|min:0',
        ]);

        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga'       => $request->harga,
        ]);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data'    => $barang,
        ], 201);
    }

    public function show($kode)
    {
        $barang = Barang::where('kode_barang', $kode)->first();
        if (! $barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'success', 'data' => $barang]);
    }
}