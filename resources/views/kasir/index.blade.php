@extends('layouts.app')

@section('title', 'Kasir')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <h2 class="card-title text-lg mb-4">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i> Form Kasir
                </h2>

                <form action="{{ route('kasir.store') }}" method="POST">
                    @csrf

                    {{-- Tabel Barang --}}
                    <div class="overflow-x-auto">
                        <table class="table w-full" id="tabel-barang">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th width="120">Harga</th>
                                    <th width="100">Jumlah</th>
                                    <th width="120">Total</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="barang_id[]" class="select select-bordered w-full barang-select"
                                            required>
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                                                    {{ $b->nama }} - Stok: {{ $b->stok }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" class="input input-bordered harga w-full bg-base-200"
                                            name="harga[]" readonly></td>
                                    <td><input type="number" class="input input-bordered jumlah w-full" name="jumlah[]"
                                            min="1" value="1"></td>
                                    <td><input type="number" class="input input-bordered total w-full bg-base-200"
                                            name="total[]" readonly></td>
                                    <td><button type="button" class="btn btn-error btn-sm hapus-baris"><i
                                                data-lucide="trash-2" class="w-4 h-4"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Tombol Tambah Barang --}}
                    <div class="mt-4">
                        <button type="button" id="tambah-baris" class="btn btn-secondary btn-sm">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Barang
                        </button>
                    </div>

                    {{-- Total Keseluruhan --}}
                    <div class="mt-6 flex justify-end items-center">
                        <label class="mr-2 font-bold">Grand Total:</label>
                        <input type="number" id="grand-total" name="grand_total"
                            class="input input-bordered bg-base-200 w-48" readonly>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('kasir.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="w-4 h-4"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function hitungTotalRow(row) {
            let harga = parseFloat(row.querySelector('.harga').value) || 0;
            let jumlah = parseInt(row.querySelector('.jumlah').value) || 0;
            row.querySelector('.total').value = harga * jumlah;
            hitungGrandTotal();
        }

        function hitungGrandTotal() {
            let total = 0;
            document.querySelectorAll('.total').forEach(function(el) {
                total += parseFloat(el.value) || 0;
            });
            document.getElementById('grand-total').value = total;
        }

        // Event: pilih barang
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('barang-select')) {
                let harga = e.target.options[e.target.selectedIndex].getAttribute('data-harga') || 0;
                let row = e.target.closest('tr');
                row.querySelector('.harga').value = harga;
                hitungTotalRow(row);
            }
        });

        // Event: ubah jumlah
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('jumlah')) {
                let row = e.target.closest('tr');
                hitungTotalRow(row);
            }
        });

        // Event: hapus baris
        document.addEventListener('click', function(e) {
            if (e.target.closest('.hapus-baris')) {
                e.target.closest('tr').remove();
                hitungGrandTotal();
            }
        });

        // Tambah baris baru
        document.getElementById('tambah-baris').addEventListener('click', function() {
            let tbody = document.querySelector('#tabel-barang tbody');
            let newRow = tbody.rows[0].cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('.jumlah').value = 1;
            tbody.appendChild(newRow);
            lucide.createIcons();
        });
    </script>
@endsection
