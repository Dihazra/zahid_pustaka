@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Buku: {{ $book->title }}</h2>
    <form action="/update-book/{{ $book->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" id="author" value="{{ $book->author }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-select" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="publication_year" class="form-label">Tahun Terbit</label>
            <input type="number" name="publication_year" class="form-control" id="publication_year" value="{{ $book->publication_year }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" rows="4" required>{{ $book->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Ganti Cover (Opsional)</label>
            <input type="file" name="cover_image" class="form-control" id="cover_image" accept="image/*">
            @if ($book->cover_image)
                <p class="mt-2">Cover saat ini:</p>
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="cover" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Buku</button>
    </form>
</div>
@endsection
