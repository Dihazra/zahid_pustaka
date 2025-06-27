<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'zahid_pinjam';

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }
}
