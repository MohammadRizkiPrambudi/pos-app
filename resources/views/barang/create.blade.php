@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="max-w-2xl mx-auto mt-12">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <h2 class="card-title text-lg mb-4"><i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Barang</h2>
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf

                    {{-- Kode Barang --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Kode Barang</span>
                            <input type="text" name="kode_barang" placeholder="Masukkan Kode Barang"
                                value="{{ old('kode_barang') }}" readonly required class="input input-md w-full">
                        </label>
                    </div>

                    {{-- Nama Barang --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Nama Barang</span>
                            <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang"
                                value="{{ old('nama_barang') }}" required class="input input-md w-full">
                        </label>
                    </div>

                    {{-- Harga --}}
                    <div class="form-control mb-4">
                        <label class="floating-label">
                            <span>Harga</span>
                            <input type="number" name="harga" placeholder="Masukkan harga" value="{{ old('harga') }}"
                                required class="input input-md w-full">
                        </label>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('barang.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="w-4 h-4"></i> Simpan
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
