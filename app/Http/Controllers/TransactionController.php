<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi (Read)
    public function index()
    {
        // Mengambil semua transaksi dari database dan mem-paginate 10 data per halaman
        // Disertai dengan relasi customer dan product untuk menampilkan data terkait
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);

        // Return view dengan data transaksi
        return view('transactions.index', compact('transactions'));
    }

    // Menampilkan form untuk membuat transaksi baru (Create)
    public function create()
    {
        // Mengambil semua customer dan product untuk ditampilkan pada form select
        $customers = Customer::all();
        $products = Product::all();

        // Return view untuk menampilkan form
        return view('transactions.create', compact('customers', 'products'));
    }

    // Menyimpan data transaksi baru ke database (Store)
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        // Menyimpan transaksi baru ke database
        Transaction::create($request->all());

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan detail transaksi (Show)
    public function show($id)
    {
        // Cari transaksi berdasarkan ID termasuk relasi customer dan product
        $transaction = Transaction::with(['customer', 'product'])->findOrFail($id);

        // Return view dengan data transaksi
        return view('transactions.show', compact('transaction'));
    }

    // Menampilkan form untuk mengedit transaksi yang ada (Edit)
    public function edit($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Ambil semua customer dan product untuk form select
        $customers = Customer::all();
        $products = Product::all();

        // Return view dengan data transaksi yang akan di-edit
        return view('transactions.edit', compact('transaction', 'customers', 'products'));
    }

    // Memperbarui data transaksi di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi data dari form
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Update transaksi di database
        $transaction->update($request->all());

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Menghapus transaksi dari database (Delete)
    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Hapus transaksi dari database
        $transaction->delete();

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Method tambahan untuk menampilkan transaksi berdasarkan customer
    public function byCustomer($customerId)
    {
        // Cari customer berdasarkan ID
        $customer = Customer::findOrFail($customerId);
        
        // Ambil semua transaksi milik customer tersebut
        $transactions = $customer->transactions()->with('product')->paginate(10);
        
        // Return view dengan data transaksi
        return view('transactions.by-customer', compact('transactions', 'customer'));
    }
}