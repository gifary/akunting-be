<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Participant extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name', 'email','nip','phone_country_code','phone','birth_date','unique_code','gender', 'status' ,'billing_cycle'
    ];

    public function classes(){
        return $this->belongsToMany(Classes::class,'class_participants','participant_id');
    }

    public function scopeDueToday($query){
        $currentDate = Carbon::now()->setTimezone('Asia/Jakarta');
        return $query->where('billing_cycle', '=', $currentDate->day);
    }

    public function scopeDueByDate($query, $data){
        return $query->where('billing_cycle', '=', $data);
    }

}
