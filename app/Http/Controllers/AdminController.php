<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;

class AdminController extends Controller
{
    public function dashboard()
    {
        $books = Book::latest()->get();
        $peminjaman = Pinjam::with('user', 'book')->latest()->get();

        return view('admin.dashboard', compact('books', 'peminjaman'));
    }
}
