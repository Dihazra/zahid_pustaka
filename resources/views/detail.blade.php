@extends('layouts.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            {{-- Gambar Buku --}}
            <div class="col-md-4 mb-4">
                <img src="{{ Storage::url($book->cover_image) }}" class="book-detail-cover" alt="Cover of {{ $book->title }}">

            </div>

            {{-- Detail Buku --}}
            <div class="col-md-8">
                <h1 class="fw-bold">{{ $book->title }}</h1>
                <p class="lead text-muted mb-3">oleh {{ $book->author }}</p>
                <hr>

                <p><strong>Deskripsi:</strong></p>
                <p>{{ $book->description }}</p>

                <p class="mt-3"><strong>Tahun Terbit:</strong> {{ $book->publication_year }}</p>
                <p><strong>Kategori:</strong> {{ $book->category->name ?? 'N/A' }}</p>

                <div class="mt-4">
                    {{-- Cek apakah user sudah login --}}
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login untuk Pinjam</a>
                    @else
                        {{-- Cek status ketersediaan buku --}}
                        @php
                            $isBookLoaned = \App\Models\Pinjam::where('book_id', $book->id)
                                ->whereIn('status', ['Dipinjam', 'Menunggu Konfirmasi'])
                                ->exists();
                        @endphp

                        @if ($isBookLoaned)
                            <button class="btn btn-secondary btn-lg" disabled>Tidak Tersedia</button>
                            <p class="text-danger mt-2">Buku ini sedang dipinjam atau menunggu konfirmasi.</p>
                        @else
                            {{-- Form untuk meminjam buku --}}
                            <form action="{{ route('pinjam.book', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">Pinjam Buku Ini</button>
                            </form>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
