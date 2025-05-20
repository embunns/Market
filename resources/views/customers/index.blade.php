@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Daftar Customer') }}</h5>
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> {{ __('Tambah Customer Baru') }}
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
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
                                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">
                                                    {{ __('Detail') }}
                                                </a>
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
</div>
@endsection