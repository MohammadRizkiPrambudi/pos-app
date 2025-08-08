<?php
namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function kasir()
    {
        return view('kasir.index');
    }

    public function store(Request $request)
    {
        $items = json_decode($request->items_json, true);

        if (! $items || count($items) === 0) {
            return back()->with('error', 'Tidak ada barang yang dibeli.');
        }

        DB::beginTransaction();
        try {
            $total_barang = 0;
            $total_harga  = 0;

            foreach ($items as $item) {
                $total_barang += $item['jumlah'];
                $total_harga += $item['harga'] * $item['jumlah'];
            }

            $transaksi = Transaksi::create([
                'tanggal'      => Carbon::now(),
                'total_barang' => $total_barang,
                'total_harga'  => $total_harga,
            ]);

            foreach ($items as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id'    => $item['id'],
                    'harga'        => $item['harga'],
                    'jumlah'       => $item['jumlah'],
                ]);
            }

            DB::commit();
            return redirect()->route('kasir')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transaksi gagal disimpan.');
        }
    }

    public function riwayat()
    {
        $transaksi = Transaksi::latest()->paginate(10);
        return view('riwayat-transaksi.index', compact('transaksi'));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('detail.barang')->findOrFail($id);

        $items = $transaksi->detail->map(function ($d) {
            return [
                'nama_barang' => $d->barang->nama_barang,
                'jumlah'      => $d->jumlah,
                'harga'       => $d->harga,
                'subtotal'    => $d->harga * $d->jumlah,
            ];
        });

        return response()->json([
            'items' => $items,
            'total' => $transaksi->total_harga,
        ]);
    }

}