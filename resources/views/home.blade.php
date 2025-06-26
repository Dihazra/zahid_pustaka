@extends('layouts.template')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1>Semua Buku</h1>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        {{-- Loop through your books data --}}
        {{-- You would pass a $books variable from your controller --}}
        @php
            $books = [
                ['title' => 'Bintang', 'author' => 'Tere liye', 'cover' => 'https://via.placeholder.com/250x350.png?text=Cover+Bintang'],
                ['title' => 'Matahari', 'author' => 'Tere liye', 'cover' => 'https://via.placeholder.com/250x350.png?text=Cover+Matahari'],
                ['title' => 'Tentang kamu', 'author' => 'Tere liye', 'cover' => 'https://via.placeholder.com/250x350.png?text=Cover+Tentang+Kamu'],
                ['title' => 'Gusdur', 'author' => 'Greg borton', 'cover' => 'https://via.placeholder.com/250x350.png?text=Cover+Gusdur'],
                ['title' => 'Habibie', 'author' => 'Biografi Politik', 'cover' => 'https://via.placeholder.com/250x350.png?text=Cover+Habibie'],
                ['title' => 'Vol. 58', 'author' => '', 'cover' => 'https://via.placeholder.com/250x350.png?text=Manga+Vol+58'],
                ['title' => 'Vol. 71', 'author' => '', 'cover' => 'https://via.placeholder.com/250x350.png?text=Manga+Vol+71'],
                // Add more books as needed
            ];
        @endphp

        @foreach ($books as $book)
            <div class="col">
                <div class="card book-card h-100 rounded-3">
                    <img src="{{ $book['cover'] }}" class="card-img-top book-cover" alt="Cover of {{ $book['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book['title'] }}</h5>
                        <p class="card-text">{{ $book['author'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection