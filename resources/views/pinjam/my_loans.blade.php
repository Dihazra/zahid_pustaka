@extends('layouts.template')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Peminjaman Saya</h1>
        <hr>

        @if ($loans->isEmpty())
            <div class="alert alert-info">
                Anda belum memiliki peminjaman buku.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->book->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d F Y') }}</td>
                                <td>
                                    @if ($loan->status == 'pinjam')
                                        <span class="badge bg-primary">{{ $loan->status }}</span>
                                    @elseif ($loan->status == 'menunggu konfirmasi')
                                        <span class="badge bg-warning">{{ $loan->status }}</span>
                                    @elseif ($loan->status == 'kembali')
                                        <span class="badge bg-success">{{ $loan->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $loan->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $loan->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection