<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark fw-bold">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title m-0">{{ __('Semua Produk') }}</h5>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            {{ __('Tambah Produk Baru') }}
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
                                    <th>{{ __('Nama Produk') }}</th>
                                    <th>{{ __('Deskripsi') }}</th>
                                    <th>{{ __('Harga') }}</th>
                                    <th>{{ __('Kategori') }}</th>
                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                                        <td colspan="5" class="text-center text-muted">Tidak ada produk tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
