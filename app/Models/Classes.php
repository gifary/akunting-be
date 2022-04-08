<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends BaseModel
{
    use HasFactory;

    protected $fillable=[
        'name',
        'period',
        'description',
        'price'
    ];

    public function participants(){
        return $this->belongsToMany(Participant::class,'class_participants','participant_id')->withPivot('is_active');
    }
}
