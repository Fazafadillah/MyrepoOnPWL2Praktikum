<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'cover',
        'bookshelf_id',
        'created_at,',
        'updated_at	'

    ];

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelves::class);
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id_category');
    }
}
