<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark fw-bold">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title m-0">{{ __('Semua Transaksi') }}</h5>
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                            {{ __('Tambah Transaksi Baru') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th>{{ __('Produk') }}</th>
                                    <th>{{ __('Total Harga') }}</th>
                                    <th>{{ __('Tanggal Transaksi') }}</th>
                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->customer->name }}</td>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        {{ __('Hapus') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Tidak ada transaksi tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $transactions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>