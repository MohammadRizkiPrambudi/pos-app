@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="max-w-5xl mx-auto mt-9">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Daftar Barang</h1>
                        <a href="{{ url('/barang/create') }}" class="btn btn-primary flex items-center gap-2">
                            <i data-lucide="plus"></i> Tambah Barang
                        </a>
                </div>

                {{-- Alert --}}
                @if (session('success'))
                    <div role="alert" class="alert alert-success mb-4" id="alert">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div role="alert" class="alert alert-error mb-4" id="alert">
                        <i data-lucide="x-circle" class="w-5 h-5"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                {{-- Table Responsive --}}
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barang as $b)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->kode_barang }}</td>
                                    <td>{{ $b->nama_barang }}</td>
                                    <td>Rp{{ number_format($b->harga, 0, ',', '.') }}</td>
                                    <td class="flex justify-center gap-2">
                                        <a href="{{ route('barang.edit', $b->id) }}"
                                            class="btn btn-sm btn-warning flex items-center gap-1">
                                            <i data-lucide="edit"></i> Edit
                                        </a>
                                        <button type="button" onclick="showDeleteConfirm({{ $b->id }})"
                                            class="btn btn-sm btn-error flex items-center gap-1">
                                            <i data-lucide="trash-2"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $barang->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Alert Konfirmasi Delete -->
    <div id="deleteAlert"
        class="alert alert-vertical sm:alert-horizontal hidden fixed 
           top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
           shadow-lg bg-base-100 border border-error z-50 p-4">
        <i data-lucide="alert-triangle" class="text-warning w-6 h-6"></i>
        <span>Yakin ingin menghapus data ini?</span>
        <div>
            <button onclick="hideDeleteConfirm()" class="btn btn-sm">Batal</button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-error">Hapus</button>
            </form>
        </div>
    </div>

    <script>
        function showDeleteConfirm(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/barang/${id}`; // route delete
            document.getElementById('deleteAlert').classList.remove('hidden');
        }

        function hideDeleteConfirm() {
            document.getElementById('deleteAlert').classList.add('hidden');
        }

        setTimeout(() => {
            const alert = document.getElementById('alert');
            if (alert) alert.remove();
        }, 3000);

        lucide.createIcons();
    </script>
@endsection
