<x-app-layout>
    <x-slot:header>
        <h2 class="h4 text-dark fw-bold">
            {{ __('Tambah Transaksi Baru') }}
        </h2>
    </x-slot:header>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">{{ __('Customer') }}</label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                            <option value="">-- Pilih Customer --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} - {{ $customer->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="product_id" class="form-label">{{ __('Produk') }}</label>
                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="total_price" class="form-label">{{ __('Total Harga') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{ old('total_price') }}" required>
                        </div>
                        @error('total_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">{{ __('Tanggal Transaksi') }}</label>
                        <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mengisi otomatis harga produk ketika produk dipilih
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const totalPriceInput = document.getElementById('total_price');
            
            // Set harga awal jika produk sudah dipilih
            if (productSelect.value) {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                totalPriceInput.value = selectedOption.dataset.price;
            }
            
            // Update harga ketika produk berubah
            productSelect.addEventListener('change', function() {
                if (this.value) {
                    const selectedOption = this.options[this.selectedIndex];
                    totalPriceInput.value = selectedOption.dataset.price;
                } else {
                    totalPriceInput.value = '';
                }
            });
        });
    </script>
</x-app-layout>