@extends('layouts.app')

@section('title', 'Kasir POS')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <h2 class="card-title text-lg mb-4 flex items-center gap-2">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i> Kasir POS
                </h2>

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error mb-4">{{ session('error') }}</div>
                @endif

                {{-- Input Kode Barang --}}
                <div class="flex gap-2 mb-4">
                    <input type="text" id="kode_barang" placeholder="Contoh: BRG001" class="input input-bordered flex-1"
                        autofocus>
                    <button type="button" onclick="tambahBarang()" class="btn btn-primary">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah
                    </button>
                </div>

                {{-- Form Keranjang --}}
                <form method="POST" action="{{ route('kasir.store') }}">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang-body"></tbody>
                        </table>
                    </div>

                    {{-- Total --}}
                    <div class="flex justify-between items-center mt-4">
                        <h3 class="text-lg font-bold">Total: Rp<span id="total_harga">0</span></h3>
                        <input type="hidden" name="items_json" id="items_json">
                        <button type="submit" class="btn btn-success">
                            <i data-lucide="credit-card" class="w-4 h-4"></i> Bayar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        let keranjang = [];

        function tambahBarang() {
            let kode = document.getElementById('kode_barang').value.trim();
            if (!kode) return alert('Masukkan kode barang');

            fetch(`/api/barang/${kode}`)
                .then(res => res.json())
                .then(data => {
                    if (data.message !== 'success') {
                        alert('Barang tidak ditemukan');
                        return;
                    }

                    let barang = data.data;
                    let existing = keranjang.find(i => i.id === barang.id);

                    if (existing) {
                        existing.jumlah++;
                    } else {
                        keranjang.push({
                            id: barang.id,
                            nama: barang.nama_barang,
                            harga: barang.harga,
                            jumlah: 1
                        });
                    }

                    document.getElementById('kode_barang').value = '';
                    renderKeranjang();
                });
        }

        function renderKeranjang() {
            let tbody = document.getElementById('keranjang-body');
            tbody.innerHTML = '';
            let total = 0;

            keranjang.forEach((item, index) => {
                let subtotal = item.harga * item.jumlah;
                total += subtotal;

                tbody.innerHTML += `
                    <tr>
                        <td>${item.nama}</td>
                        <td>Rp${item.harga}</td>
                        <td>
                            <input type="number" min="1" value="${item.jumlah}"
                                class="input input-bordered w-20"
                                onchange="ubahJumlah(${index}, this.value)">
                        </td>
                        <td>Rp${subtotal}</td>
                        <td>
                            <button type="button" onclick="hapusItem(${index})" class="btn btn-error btn-xs">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('total_harga').innerText = total;
            document.getElementById('items_json').value = JSON.stringify(keranjang);
            lucide.createIcons();
        }

        function ubahJumlah(index, qty) {
            keranjang[index].jumlah = parseInt(qty);
            renderKeranjang();
        }

        function hapusItem(index) {
            keranjang.splice(index, 1);
            renderKeranjang();
        }
    </script>
@endsection
