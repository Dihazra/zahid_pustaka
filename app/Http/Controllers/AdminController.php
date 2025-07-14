<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function tambah()
    {
        $books = Book::latest()->get();
        $peminjaman = Pinjam::with('user', 'book')->latest()->get();

        return view('admin.tambah', compact('books', 'peminjaman'));
    }

    public function users()
    {
        $books = Book::latest()->get();
        $peminjaman = Pinjam::with('user', 'book')->latest()->get();

        return view('admin.user-list', compact('books', 'peminjaman'));
    }

     public function index()
    {
        $jumlahPengunjung = Pinjam::distinct('user_id')->count('user_id'); // total user unik
        $jumlahPinjam = Pinjam::distinct('book_id')->count('book_id');// total data pinjam
        $pinjamAktif = Pinjam::where('status', 'pinjam')->count();
        $pinjamSelesai = Pinjam::where('status', 'kembali')->count();
        $jumlahBuku = Book::count();

        $bukuPopuler = DB::table('zahid_pinjam')
        ->join('zahid_books', 'zahid_pinjam.book_id', '=', 'zahid_books.id')
        ->select('zahid_books.id', 'zahid_books.title', 'zahid_books.author', DB::raw('COUNT(zahid_pinjam.book_id) as total'))
        ->groupBy('zahid_books.id', 'zahid_books.title', 'zahid_books.author')
        ->orderByDesc('total')
        ->limit(5)
        ->get();


        return view('admin.dashboard', compact(
            'jumlahPengunjung',
            'jumlahPinjam',
            'pinjamAktif',
            'pinjamSelesai',
            'jumlahBuku',
            'bukuPopuler'
        ));
    }
}
