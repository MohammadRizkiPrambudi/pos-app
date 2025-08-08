@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="max-w-5xl mx-auto mt-9">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Riwayat Transaksi</h2>
                </div>

                {{-- Table Responsive --}}
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total Barang</th>
                                <th>Total Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $t->total_barang }}</td>
                                    <td>Rp{{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                    <td class="flex justify-center">
                                        <button class="btn btn-sm btn-info flex items-center gap-1"
                                            onclick="showDetail({{ $t->id }})">
                                            <i data-lucide="eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="modalDetail" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="text-lg font-bold">Detail Transaksi</h3>
            {{-- <p class="py-4">Memuat data...</p> --}}
            <div id="detailContent" class="overflow-x-auto">
                <p class="text-center text-gray-500">Memuat data...</p>
                {{-- <p class="py-4">Memuat data...</p> --}}
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        lucide.createIcons();

        function showDetail(id) {
            const modal = document.getElementById('modalDetail');
            const content = document.getElementById('detailContent');
            content.innerHTML = `<p class="text-center text-gray-500">Memuat data...</p>`;
            console.log(id)

            fetch(`/riwayat-transaksi/${id}`)
                .then(res => res.json())
                .then(data => {
                    let html = `
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    data.items.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.nama_barang}</td>
                                <td>${item.jumlah}</td>
                                <td>Rp${parseInt(item.harga).toLocaleString('id-ID')}</td>
                                <td>Rp${parseInt(item.subtotal).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });

                    html += `
                            </tbody>
                        </table>
                        <div class="mt-4 text-right font-bold">
                            Total: Rp${parseInt(data.total).toLocaleString('id-ID')}
                        </div>
                    `;

                    content.innerHTML = html;
                })
                .catch(err => {
                    content.innerHTML = `<p class="text-red-500">Gagal memuat data.</p>`;
                });

            modal.showModal();
        }
    </script>
@endsection
