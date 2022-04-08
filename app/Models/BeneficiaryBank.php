<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryBank extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name', 'accoount_number','account_name','bank_code'
    ];
}
