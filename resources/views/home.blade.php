@extends('layouts.sidebar')

@section('content')
<div class="d-flex justify-content-center">


    <div class="blur-container p-4 rounded-4 shadow-lg w-100" style="max-width: 1200px;">
        <h2 class="text-center mb-4 fw-bold">Semua Buku</h2>
        

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
            @foreach ($books as $book)
                <div class="col">
                    <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none text-dark">
                        <div class="card book-card h-100">
                            <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top book-cover" alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->author }}</p>
                                
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

