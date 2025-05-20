<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang di panel admin! Anda berhasil login.") }}
                </div>

                <div class="p-6 border-t border-gray-200">
                    <div class="row g-4">
                        <!-- Produk -->
                        <div class="col-md-4">
                            <a href="{{ route('products.index') }}" class="btn btn-primary w-100 py-3">
                                Manajemen Produk
                            </a>
                        </div>

                        <!-- Pelanggan -->
                        <div class="col-md-4">
                            <a href="{{ route('customers.index') }}" class="btn btn-success w-100 py-3">
                                Data Pelanggan
                            </a>
                        </div>

                        <!-- Transaksi -->
                        <div class="col-md-4">
                            <a href="{{ route('transactions.index') }}" class="btn btn-danger w-100 py-3">
                                Riwayat Transaksi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>