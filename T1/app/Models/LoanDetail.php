<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $table = 'loan_details';

    protected $fillable = [
        'loan_id',
        'book_id',
        'is_return',
        'created_at',
        'updated_at'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function return()
    {
        return $this->hasOne(ReturnModel::class, 'loan_detail_id');
    }
}
