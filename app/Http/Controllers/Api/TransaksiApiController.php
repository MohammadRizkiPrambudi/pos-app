<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TransaksiApiController extends Controller
{
    public function show($id)
    {
        $transaksi = Transaksi::with('detail.barang')->findOrFail($id);
        return response()->json($transaksi);
    }
}