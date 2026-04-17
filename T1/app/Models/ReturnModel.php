<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
     protected $table = 'returns';

    protected $fillable = [
        'loan_detail_id', 
        'charge', 
        'amount', 
        'created_at',
        'updated_at'
    ];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class);
    }
}
