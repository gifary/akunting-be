<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'transaction_date', 'source','is_validated','invoice_id'
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
