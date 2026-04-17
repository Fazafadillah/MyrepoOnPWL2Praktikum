<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category', 'created_at', 'updated_at'];

    public function books()
    {
        return $this->hasMany(Book::class, 'id_category');
    }
}
