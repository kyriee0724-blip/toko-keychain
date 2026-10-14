<?php

namespace App\Http\Controllers;

use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    /**
     * Menampilkan daftar skema
     */
    public function index()
    {
        // Ambil skema beserta jumlah pesertanya
        // withCount digunakan untuk menghitung jumlah peserta
        // yang terhubung dengan setiap skema
        $schemas = Schema::withCount('participants')->latest()->paginate(10);

        // Menampilkan halaman daftar skema
        // dan mengirim data schemas ke view
        return view('schemas.index', compact('schemas'));
    }

    /**
     * Menampilkan form tambah skema
     */
    public function create()
    {
        // Menampilkan halaman form untuk menambahkan skema baru
        return view('schemas.create');
    }

    /**
     * Menyimpan skema baru
     */
    public function store(Request $request)
    {
        // Melakukan validasi data yang dikirim dari form
        $validated = $request->validate([
            // Kode wajib diisi, berupa teks, maksimal 50 karakter
            // dan tidak boleh sama dengan kode skema yang sudah ada
            'code'        => 'required|string|max:50|unique:schemas,code',

            // Nama skema wajib diisi dan maksimal 255 karakter
            'name'        => 'required|string|max:255',

            // Deskripsi tidak wajib diisi
            'description' => 'nullable|string',
        ]);

        // Menyimpan data skema yang sudah divalidasi ke database
        Schema::create($validated);

        // Mengarahkan kembali ke halaman daftar skema
        // dan menampilkan pesan bahwa skema berhasil ditambahkan
        return redirect()->route('schemas.index')->with('success', 'Skema berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit skema
     */
    public function edit(Schema $schema)
    {
        // Menampilkan halaman edit skema
        // dan mengirim data schema yang akan diedit ke view
        return view('schemas.edit', compact('schema'));
    }

    /**
     * Memperbarui data skema
     */
    public function update(Request $request, Schema $schema)
    {
        // Melakukan validasi data yang akan diperbarui
        $validated = $request->validate([
            // Kode wajib diisi dan maksimal 50 karakter
            // Kode tidak boleh sama dengan skema lain
            // tetapi kode milik skema yang sedang diedit tetap diperbolehkan
            'code'        => 'required|string|max:50|unique:schemas,code,' . $schema->id,

            // Nama skema wajib diisi dan maksimal 255 karakter
            'name'        => 'required|string|max:255',

            // Deskripsi tidak wajib diisi
            'description' => 'nullable|string',
        ]);

        // Memperbarui data skema dengan data yang sudah divalidasi
        $schema->update($validated);

        // Mengarahkan kembali ke halaman daftar skema
        // dan menampilkan pesan bahwa skema berhasil diperbarui
        return redirect()->route('schemas.index')->with('success', 'Skema berhasil diperbarui!');
    }

    /**
     * Menghapus skema
     */
    public function destroy(Schema $schema)
    {
        // Cek jika skema masih memiliki peserta terikat
        // Jika jumlah peserta lebih dari 0, skema tidak boleh dihapus
        if ($schema->participants()->count() > 0) {
            // Kembali ke halaman sebelumnya
            // dan menampilkan pesan bahwa skema masih digunakan
            return back()->with('error', 'Skema tidak bisa dihapus karena masih memiliki peserta!');
        }

        // Menghapus data skema dari database
        $schema->delete();

        // Mengarahkan kembali ke halaman daftar skema
        // dan menampilkan pesan bahwa skema berhasil dihapus
        return redirect()->route('schemas.index')->with('success', 'Skema berhasil dihapus!');
    }
}