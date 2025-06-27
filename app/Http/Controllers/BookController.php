<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    public function homepage(){
        $books = Book::latest()->paginate(8);
        return view('home', compact('books'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('detail', compact('book'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('books.create_book', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string',
            'category_id' => 'required|exists:zahid_categories,id',
            'description' => 'required|string',
            'publication_year' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $overPath = null;
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
        ]);

        return redirect('/')->with('Success', 'Data Buku Berhasil Disimpan.');
    }

    public function edit($id)
{
    $book = Book::findOrFail($id);
    $categories = Category::all();
    return view('books.edit_book', compact('book', 'categories'));
}

public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string',
        'category_id' => 'required|exists:zahid_categories,id',
        'description' => 'required|string',
        'publication_year' => 'required|integer',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ Solusi utama
    $coverPath = $book->cover_image ?? null;

    if ($request->hasFile('cover_image')) {
        if ($book->cover_image) {
            \Storage::disk('public')->delete($book->cover_image);
        }
        $coverPath = $request->file('cover_image')->store('covers', 'public');
    }

    $book->update([
        'title' => $validated['title'],
        'author' => $validated['author'],
        'category_id' => $validated['category_id'],
        'description' => $validated['description'],
        'publication_year' => $validated['publication_year'],
        'cover_image' => $coverPath,
    ]);

    return redirect('/')->with('Success', 'Data Buku Berhasil Diupdate.');
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

public function index(Request $request)
{
    $search = $request->input('search');

    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('author', 'like', "%{$search}%");
    })->get();

    return view('home', compact('books'));
}



    
}
