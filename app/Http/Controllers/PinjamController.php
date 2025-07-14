<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Pastikan Carbon sudah terinstal atau gunakan use statement ini

class PinjamController extends Controller
{
    /**
     * Tampilkan form detail buku dengan tombol pinjam.
     * Ini bisa diimplementasikan di BookController@show, jadi tidak perlu metode terpisah.
     */

    /**
     * Proses peminjaman buku.
     * Hanya bisa diakses oleh pengguna yang sudah login.
     */
    public function pinjam(Request $request, $bookId)
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk meminjam buku.');
        }

        // 2. Ambil data buku
        $book = Book::findOrFail($bookId);

        // 3. Cek ketersediaan buku (stok atau status)
        // Asumsikan Anda memiliki kolom 'status' atau 'stock' di tabel books.
        // Di sini saya asumsikan buku bisa dipinjam jika tidak ada di tabel pinjam dengan status 'Dipinjam'.
        $isBookLoaned = Pinjam::where('book_id', $book->id)
                                    ->whereIn('status', ['Dipinjam', 'Menunggu Konfirmasi'])
                                    ->exists();

        if ($isBookLoaned) {
            return redirect()->back()->with('error', 'Maaf, buku ini sedang tidak tersedia atau sudah dipinjam.');
        }

        // 4. Cek apakah user sudah meminjam buku ini
        $isUserAlreadyLoaned = Pinjam::where('user_id', Auth::id())
                                        ->where('book_id', $book->id)
                                        ->whereIn('status', ['Dipinjam', 'Menunggu Konfirmasi'])
                                        ->exists();
        
        if ($isUserAlreadyLoaned) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');
        }


        // 5. Buat entri baru di tabel zahid_pinjam
        try {
            $tanggalPinjam = Carbon::now();
            $tanggalKembali = $tanggalPinjam->copy()->addDays(7); // Contoh: dipinjam selama 7 hari

            Pinjam::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'status' => 'Menunggu Konfirmasi', // Status awal, butuh persetujuan admin
                'keterangan' => 'Permintaan peminjaman buku.',
            ]);

            // Opsional: Update status buku di tabel books
            // $book->status = 'Dipinjam';
            // $book->save();

            return redirect()->back()->with('success', 'Permintaan peminjaman buku berhasil diajukan. Silakan tunggu konfirmasi dari admin.');

         //...
} catch (\Exception $e) {
    // Tangani error jika terjadi
    // UNTUK DEBUGGING: Tampilkan pesan error yang sebenarnya
    dd($e->getMessage()); 
    // atau
    // return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage()); 
}
        
    }

    /**
     * Tampilkan daftar buku yang dipinjam oleh user yang sedang login.
     */
    public function myLoans()
    {
        $loans = Pinjam::where('user_id', Auth::id())
                            ->with('book') // eager load relasi book
                            ->latest()
                            ->get();

        return view('pinjam.my_loans', compact('loans'));
    }

    public function indexPinjaman()
    {
        // Pastikan hanya admin yang bisa mengakses
        // Jika Anda menggunakan Gate/Policy
        // Gate::authorize('view-admin-dashboard'); 
        // Atau middleware 'is_admin' di route

        $peminjaman = Pinjam::with(['user', 'book'])->latest()->get(); // Eager load relasi user dan book
        return view('admin.pinjaman_list', compact('peminjaman')); // Ganti 'admin.pinjaman_list' dengan nama view Anda
    }

    /**
     * Mengkonfirmasi peminjaman buku oleh admin.
     */
    public function konfirmasi($id)
    {
        // Otorisasi: Pastikan user adalah admin
        // Gate::authorize('confirm-loan');

        $pinjam = Pinjam::findOrFail($id);

        // Update status pinjaman
        $pinjam->status = 'pinjam';
        $pinjam->keterangan = 'Permintaan peminjaman disetujui.';
        $pinjam->save();

        return redirect()->back()->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    /**
     * Menolak peminjaman buku oleh admin.
     */
    public function tolak($id)
    {
        // Otorisasi: Pastikan user adalah admin
        // Gate::authorize('reject-loan');

        $pinjam = Pinjam::findOrFail($id);

        // Update status pinjaman
        $pinjam->status = 'ditolak';
        $pinjam->keterangan = 'Permintaan peminjaman ditolak oleh admin.';
        $pinjam->save();

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function kembalikan($id)
{
    $pinjam = Pinjam::findOrFail($id);

    // Hanya buku yang sedang dipinjam yang bisa dikembalikan
    if ($pinjam->status === 'pinjam') {
        $pinjam->status = 'kembali';
        $pinjam->tanggal_kembali = Carbon::now();
        $pinjam->keterangan = 'Buku telah dikembalikan.';
        $pinjam->save();

        return redirect()->back()->with('success', 'Buku berhasil ditandai sebagai dikembalikan.');
    }

    return redirect()->back()->with('error', 'Hanya buku yang sedang dipinjam yang bisa dikembalikan.');
}

}