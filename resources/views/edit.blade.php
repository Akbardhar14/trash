@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Sparepart</h1>

    <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $sparepart->nama }}"><br>

        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $sparepart->harga }}"><br>

        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $sparepart->stok }}"><br>

        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control"><br>

        @if ($sparepart->gambar)
            <img src="{{ asset('storage/' . $sparepart->gambar) }}" width="100">
        @endif

        <br><br>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
