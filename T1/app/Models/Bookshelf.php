<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookshelves extends Model
{
    protected $table = 'Bookshelves';
    protected $fillable =
    [
        'code',
        'name',

    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
