@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Buku Baru</h2>
    <form action="/create-book" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" id="author" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-select" id="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="publication_year" class="form-label">Tahun Terbit</label>
            <input type="number" name="publication_year" class="form-control" id="publication_year" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Buku</label>
            <input type="file" name="cover_image" class="form-control" id="cover_image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan Buku</button>
    </form>
</div>
@endsection
