@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Admin</h2>


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
            <th>Aksi</th> </tr>
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
                <td>
                    {{-- Tambahkan tombol aksi di sini --}}
                    @if ($pinjam->status == 'menunggu konfirmasi')
                        <form action="{{ route('pinjam.konfirmasi', $pinjam->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Konfirmasi</button>
                        </form>
                        <form action="{{ route('pinjam.tolak', $pinjam->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                    @elseif ($pinjam->status == 'pinjam')
                        <form action="{{ route('pinjam.kembalikan', $pinjam->id) }}" method="POST" class="d-inline">
                     @csrf
                    <button type="submit" class="btn btn-sm btn-info">dikembalikan</button>
                    </form>
                    @else
                        <button class="btn btn-sm btn-secondary" disabled>Tidak Ada Aksi</button>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">Belum ada data peminjaman</td></tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
