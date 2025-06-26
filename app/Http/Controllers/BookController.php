<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function homepage(){
        $books = Book::latest()->paginate(6);
        return view('homepage', compact('books'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('detail', compact('book'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('create_book' ,compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'publication_year' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->title);

        $coverPath = null;
        if ($request->hasfile('cover_image')) {
            $coverPath = $request->file('cover_image')->store
            ('covers', 'public');
        }

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'publication_year' => $validated['publication_year'],
            'cover_image' => $coverPath,
            'slug' => $slug,
        ]);

        return redirect('/')->with('Success', 'Data Book Berhasil Disimpan.');
    }

    public function edit($id)
{
    $book = Book::findOrFail($id);
    $categories = Category::all();
    return view('edit_book', compact('book', 'categories'));
}

public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'synopsis' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $slug = Str::slug($request->title);
    $book->slug = $slug;

    if ($request->hasFile('cover_image')) {
        // Hapus cover lama
        if ($book->cover_image) {
            \Storage::disk('public')->delete($book->cover_image);
        }

        $coverPath = $request->file('cover_image')->store('covers', 'public');
        $book->cover_image = $coverPath;
    }

    $book->update([
        'title' => $validated['title'],
        'author' => $request->input('author', $book->author), // Menggunakan input author jika ada
        'category_id' => $validated['category_id'],
    ]);

    return redirect('/')->with('Success', 'Data Book Berhasil Diupdate.');
}

public function destroy($id)
{
    $book = Book::findOrFail($id);

    if ($book->cover_image) {
        \Storage::disk('public')->delete($book->cover_image);
    }

    $book->delete();

    return redirect('/')->with('Success', 'Data Book Berhasil Dihapus.');
}


}
