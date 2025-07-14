@extends('layouts.sidebar')

@section('content')

<style>
    .btn-view-lg {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(255, 255, 255, 0.9);
    color: #000;
    padding: 6px 20px;
    border-radius: 14px;
    font-weight: 500;
    font-size: 0.9rem;
    text-decoration: none;
    border: none;
    transition: 0.2s ease-in-out;
}
.btn-view-lg:hover {
    background-color: #FFA500;
}
</style>
    <div class="container mt-5">
        <div class="row">
            {{-- Gambar Buku --}}
            <div class="col-md-4 mb-4">
                <img src="{{ Storage::url($book->cover_image) }}" class="book-detail-cover" alt="Cover of {{ $book->title }}">

            </div>

            {{-- Detail Buku --}}
            <div class="col-md-8">
                <h1 class="fw-bold">{{ $book->title }}</h1>
                <p class="lead text-white mb-3" ">oleh {{ $book->author }}</p>
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
                        // Cek apakah user yang login sudah meminjam buku ini
                        $isBookLoanedByUser = \App\Models\Pinjam::where('book_id', $book->id)
                            ->where('user_id', auth()->id())
                            ->whereIn('status', ['pinjam', 'menunggu konfirmasi'])
                            ->exists();

                        // Cek apakah buku sedang dipinjam oleh user lain
                        $isBookLoanedByOthers = \App\Models\Pinjam::where('book_id', $book->id)
                            ->where('user_id', '!=', auth()->id())
                            ->whereIn('status', ['pinjam', 'menunggu konfirmasi'])
                            ->exists();
                        @endphp

                        @if ($isBookLoanedByUser)
                            <button class="btn btn-secondary btn-lg" disabled>Tidak Tersedia</button>
                            <p class="text-danger mt-2">Anda sudah meminjam buku ini dan belum mengembalikannya.</p>
                        @elseif ($isBookLoanedByOthers)
                            <button class="btn btn-secondary btn-lg" disabled>Tidak Tersedia</button>
                            <p class="text-danger mt-2">Buku sedang dipinjam oleh pengguna lain.</p>
                        @else
                            <form action="{{ route('pinjam.book', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-view-lg btn-lg">Pinjam Buku Ini</button>
                            </form>
                        @endif

                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
