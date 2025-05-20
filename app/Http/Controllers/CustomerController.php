<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar customer
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua customer dari database dan mem-paginate 10 data per halaman
        $customers = Customer::latest()->paginate(10);

        // Return view dengan data customer
        return view('customers.index', compact('customers'));
    }

    /**
     * Menampilkan form untuk membuat customer baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return view untuk menampilkan form
        return view('customers.create');
    }

    /**
     * Menyimpan data customer baru ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            // Menyimpan customer baru ke database
            Customer::create($validated);
            
            DB::commit();
            
            // Redirect ke halaman daftar customer dengan pesan sukses
            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail customer
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cari customer berdasarkan ID termasuk relasi transaksi
        $customer = Customer::with('transactions')->findOrFail($id);

        // Return view dengan data customer
        return view('customers.show', compact('customer'));
    }

    /**
     * Menampilkan form untuk mengedit customer yang ada
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Cari customer berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Return view dengan data customer yang akan di-edit
        return view('customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data customer di database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Cari customer berdasarkan ID
        $customer = Customer::findOrFail($id);
        
        // Validasi data dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            // Update customer di database
            $customer->update($validated);
            
            DB::commit();
            
            // Redirect ke halaman daftar customer dengan pesan sukses
            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus customer dari database
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            // Cari customer berdasarkan ID
            $customer = Customer::findOrFail($id);

            // Hapus customer dari database
            $customer->delete();
            
            DB::commit();
            
            // Redirect ke halaman daftar customer dengan pesan sukses
            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}