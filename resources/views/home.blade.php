@extends('layouts.sidebar')

@section('content')

<style>
    

.book-card-lg {
    background-color: #1b1c1e;
    border-radius: 20px;
    overflow: hidden;
    color: white;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s;
    height: 100%;
}

.book-card-lg:hover {
    transform: scale(1.04);
}

.book-card-bg {
    position: relative;
    height: 500px; /* Tinggi card lebih besar */
    background-color: #000;
    overflow: hidden;
}

.bg-img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
}

.cover-img-lg {
    position: absolute;
    bottom: 65px;
    left: 50%;
    transform: translateX(-50%);
    height: 400px; /* cover besar */
    object-fit: contain;
    z-index: 2;
}

.btn-view-lg {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(255, 255, 255, 0.9);
    color: #000;
    padding: 6px 20px;
    border-radius: 14px;
    font-weight: 500;
    font-size: 0.9rem;
    z-index: 3;
    text-decoration: none;
    border: none;
    transition: 0.2s ease-in-out;
}
.btn-view-lg:hover {
    background-color: #FFA500;
}

.book-info {
    padding: 16px;
    background-color: #1b1c1e;
    text-align: center;
    opacity: 0.8;
}

.book-info .title {
    font-weight: bold;
    font-size: 1rem;
    color: #fff;
}

.book-info .author {
    font-size: 0.85rem;
    color: #bbb;
}

.ket {
    font-size: 0.8rem;
    color: #bbb;
    margin-bottom: 50px;
}



</style>
<div class="container mt-4">
    <h3 class="text-white fw-bold ">Semua Buku</h3>
    <p class="ket">Menampilkan semua buku yang tersedia pada platfrom ini</p>

    <div class="row g-4 justify-content-center">
        @foreach ($books as $book)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2-4 "> {{-- custom 5 kolom --}}
            <div class="book-card-lg">
                <div class="book-card-bg">
                    <img src="{{ Storage::url($book->cover_image) }}" alt="Background" class="bg-img">
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-view-lg">Lihat Buku</a>
                </div>
                <div class="book-info" ">
                    <div class="title">{{ $book->title }}</div>
                    <div class="author">{{ $book->author }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    
</div>



@endsection

