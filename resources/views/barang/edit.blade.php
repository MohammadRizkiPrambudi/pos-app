@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <div class="max-w-2xl mx-auto mt-12">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <h2 class="card-title text-lg mb-4"><i data-lucide="edit" class="w-5 h-5"></i> Edit Barang</h2>
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Kode Barang</span>
                            <input type="text" name="nama" class="input input-md w-full"
                                value="{{ old('nama', $barang->kode_barang) }}" required>
                        </label>
                    </div>

                    {{-- Nama Barang --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Nama Barang</span>
                            <input type="text" name="nama" class="input input-md w-full"
                                value="{{ old('nama', $barang->nama_barang) }}" required>
                        </label>
                    </div>

                    {{-- Harga --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Harga</span>
                        </label>
                        <input type="number" name="harga" class="input input-md w-full"
                            value="{{ old('harga', $barang->harga) }}" required>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('barang.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="w-4 h-4"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
