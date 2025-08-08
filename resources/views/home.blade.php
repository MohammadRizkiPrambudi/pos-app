@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="max-w-6xl mx-auto mt-12">
        <h1 class="text-4xl font-bold mb-4 text-center">Selamat Datang di Pos App</h1>
        <p class="text-lg text-center mb-12 text-gray-600">
            Kelola barang dan transaksi Anda dengan mudah dan cepat.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            {{-- Menu Barang --}}
            <a href="{{ url('/barang') }}"
                class="card bg-base-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all p-6 flex flex-col items-center">
                <div class="rounded-full p-3 bg-primary/10 mb-4">
                    <i data-lucide="package" class="w-10 h-10 text-primary"></i>
                </div>
                <h2 class="text-xl font-semibold">Barang</h2>
                <p class="text-sm mt-2 text-center text-gray-500">Kelola data barang dan stok.</p>
            </a>

            {{-- Menu Kasir --}}
            <a href="{{ url('/kasir') }}"
                class="card bg-base-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all p-6 flex flex-col items-center">
                <div class="rounded-full p-3 bg-success/10 mb-4">
                    <i data-lucide="credit-card" class="w-10 h-10 text-success"></i>
                </div>
                <h2 class="text-xl font-semibold">Kasir</h2>
                <p class="text-sm mt-2 text-center text-gray-500">Proses transaksi penjualan.</p>
            </a>

            {{-- Menu Riwayat --}}
            <a href="{{ url('/riwayat') }}"
                class="card bg-base-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all p-6 flex flex-col items-center">
                <div class="rounded-full p-3 bg-warning/10 mb-4">
                    <i data-lucide="clock" class="w-10 h-10 text-warning"></i>
                </div>
                <h2 class="text-xl font-semibold">Riwayat</h2>
                <p class="text-sm mt-2 text-center text-gray-500">Lihat riwayat transaksi.</p>
            </a>
        </div>
    </div>

    {{-- Render icon --}}
    <script>
        lucide.createIcons();
    </script>
@endsection
