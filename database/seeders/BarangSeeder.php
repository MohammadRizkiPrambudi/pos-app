<?php
namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode_barang' => 'BRG001', 'nama_barang' => 'Pulpen Hitam', 'harga' => 1500],
            ['kode_barang' => 'BRG002', 'nama_barang' => 'Buku Tulis', 'harga' => 5000],
            ['kode_barang' => 'BRG003', 'nama_barang' => 'Penggaris 30cm', 'harga' => 3000],
            ['kode_barang' => 'BRG004', 'nama_barang' => 'Pensil 2B', 'harga' => 2000],
            ['kode_barang' => 'BRG005', 'nama_barang' => 'Spidol Hitam', 'harga' => 4000],
        ];

        foreach ($data as $item) {
            Barang::create($item);
        }
    }
}