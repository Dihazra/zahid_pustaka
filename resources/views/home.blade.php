@extends('layouts.template')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1>Semua Buku</h1>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach ($books as $book)
            <div class="col">
                <div class="card book-card h-100 rounded-3">
                    <img src="{{ $book->cover_image_url }}" class="card-img-top book-cover" alt="Cover of {{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ $book->author }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
