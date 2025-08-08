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

                <div id="kasir-alert" class="hidden mb-4"></div>

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
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/kasir.js') }}"></script>
@endpush
