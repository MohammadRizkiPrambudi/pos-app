@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="card-title text-lg">Riwayat Transaksi</h2>
                    <a href="{{ route('kasir.create') }}" class="btn btn-primary btn-sm">
                        <i data-lucide="plus" class="w-4 h-4"></i> Transaksi Baru
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                <tr>
                                    <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $t->kasir->name }}</td>
                                    <td>Rp {{ number_format($t->grand_total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
