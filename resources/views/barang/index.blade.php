@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="max-w-6xl mx-auto mt-12">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Daftar Barang</h1>
                    <a href="{{ url('/barang/create') }}" class="btn btn-primary flex items-center gap-2">
                        <i data-lucide="plus"></i> Tambah Barang
                    </a>
                </div>

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
                                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-error flex items-center gap-1">
                                                <i data-lucide="trash-2"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $barang->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
