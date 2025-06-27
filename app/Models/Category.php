<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tambahkan properti ini untuk menentukan nama tabel secara manual
    protected $table = 'zahid_categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the books for the category.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}