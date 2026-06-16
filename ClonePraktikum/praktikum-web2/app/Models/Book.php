<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'cover',
        'bookshelf_id',
    ];

    public static function getDataBooks()
    {
        $books = Book::all();
        $books_filters = [];
        for($i = 0; $i < $books->count(); $i++){
            $books_filters[$i]['title'] = $books[$i]->title;
            $books_filters[$i]['author'] = $books[$i]->author;
            $books_filters[$i]['year'] = $books[$i]->year;
            $books_filters[$i]['publisher'] = $books[$i]->publisher;
            $books_filters[$i]['city'] = $books[$i]->city;
        }

        return $books_filters;
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id', 'id');
    }
}
