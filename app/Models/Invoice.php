<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'invoice_create_date', 'invoice_ref_id','total_billed', 'participant_id'
    ];

    public function details() {
        return $this->hasMany(InvoiceDetail::class,'invoice_id');
    }
}
