<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'invoices_id',
        'is_reduction',
        'detail_transaction',
        'detail_amount',
    ];
}
