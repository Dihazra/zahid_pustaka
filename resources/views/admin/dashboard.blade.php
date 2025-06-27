@extends('layouts.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Buku --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Buku</h4>
        <a href="/create-book" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Buku</a>
    </div>

    <table class="table table-bordered table-striped mb-5">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $i => $book)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" width="50">
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category->name ?? '-' }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>
                        <a href="/edit-book/{{ $book->id }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="/delete-book/{{ $book->id }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Peminjaman --}}
    <h4 class="mt-4">Daftar Peminjaman</h4>
    <table class="table table-bordered table-hover">
        <thead class="table-warning">
            <tr>
                <th>#</th>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $i => $pinjam)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $pinjam->user->name ?? '-' }}</td>
                    <td>{{ $pinjam->book->title ?? '-' }}</td>
                    <td>{{ $pinjam->tanggal_pinjam }}</td>
                    <td>{{ $pinjam->tanggal_kembali }}</td>
                    <td>{{ ucfirst($pinjam->status) }}</td>
                    <td>{{ $pinjam->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Belum ada data peminjaman</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
