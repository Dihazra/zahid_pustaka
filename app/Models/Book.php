<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  use HasFactory;

    protected $table = 'zahid_books';
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'category_id',
        'description',
        'cover_image',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCoverImageUrlAttribute()
    {
        return asset('storage/' . $this->cover_image);
    }
}
