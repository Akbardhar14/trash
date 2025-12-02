@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Sparepart</h1>

    <!-- FORM SEARCH -->
    <form action="{{ route('sparepart.index') }}" method="GET" class="d-flex mb-3" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" 
               placeholder="Cari sparepart..." value="{{ $search ?? '' }}">
        <button class="btn btn-primary ms-2">Cari</button>
    </form>

    <a href="{{ route('sparepart.create') }}" class="btn btn-primary mb-3">Tambah Sparepart</a>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        @foreach ($spareparts as $s)
        <tr>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->harga }}</td>
            <td>{{ $s->stok }}</td>
            <td>
                @if ($s->gambar)
                    <img src="{{ asset('storage/' . $s->gambar) }}" width="80">
                @endif
            </td>
            <td>
                <a href="{{ route('sparepart.edit', $s->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('sparepart.destroy', $s->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- PAGINATION -->
    {{ $spareparts->links() }}

</div>
@endsection
