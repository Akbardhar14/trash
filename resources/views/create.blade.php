@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Sparepart</h1>

    <form action="{{ route('sparepart.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" class="form-control"><br>

        <label>Harga</label>
        <input type="number" name="harga" class="form-control"><br>

        <label>Stok</label>
        <input type="number" name="stok" class="form-control"><br>

        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control"><br>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
