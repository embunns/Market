<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark fw-bold">
            {{ __('Daftar Customer') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title m-0">{{ __('Semua Customer') }}</h5>
                        <a href="{{ route('customers.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> {{ __('Tambah Customer Baru') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col">{{ __('Nama') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Telepon') }}</th>
                                    <th scope="col">{{ __('Alamat') }}</th>
                                    <th scope="col" width="15%">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ $customers->firstItem() + $index }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ Str::limit($customer->address, 50) }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus customer ini?')">
                                                        {{ __('Hapus') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <p class="text-muted mb-0">{{ __('Belum ada data customer.') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>