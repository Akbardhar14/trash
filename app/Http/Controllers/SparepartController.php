<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SparepartController extends Controller
{
    // ==============================
    // INDEX (LIST DATA)
    // ==============================
    public function index(Request $request)
    {
        $search = $request->search;

        $spareparts = Sparepart::when($search, function($query) use ($search) {
            $query->where('nama', 'like', "%$search%");
        })->get();

        return view('sparepart.index', compact('spareparts', 'search'));
    }

    // ==============================
    // FORM TAMBAH
    // ==============================
    public function create()
    {
        return view('sparepart.create');
    }

    // ==============================
    // SIMPAN DATA BARU
    // ==============================
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'nama'   => 'required|string|max:255',
            'harga'  => 'required|numeric|min:0',
            'stok'   => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        // UPLOAD GAMBAR JIKA ADA
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sparepart', 'public');
        }

        Sparepart::create($data);

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil ditambahkan');
    }

    // ==============================
    // FORM EDIT
    // ==============================
    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('sparepart.edit', compact('sparepart'));
    }

    // ==============================
    // SIMPAN PERUBAHAN
    // ==============================
    public function update(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'nama'   => 'required|string|max:255',
            'harga'  => 'required|numeric|min:0',
            'stok'   => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $sparepart = Sparepart::findOrFail($id);

        $data = $request->all();

        // CEK JIKA ADA GAMBAR BARU
        if ($request->hasFile('gambar')) {

            // HAPUS GAMBAR LAMA
            if ($sparepart->gambar) {
                Storage::disk('public')->delete($sparepart->gambar);
            }

            // SIMPAN GAMBAR BARU
            $data['gambar'] = $request->file('gambar')->store('sparepart', 'public');
        }

        $sparepart->update($data);

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil diupdate');
    }

    // ==============================
    // HAPUS DATA
    // ==============================
    public function destroy($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        // HAPUS GAMBAR JIKA ADA
        if ($sparepart->gambar) {
            Storage::disk('public')->delete($sparepart->gambar);
        }

        $sparepart->delete();

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil dihapus');
    }
}
