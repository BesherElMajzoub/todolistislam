<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listToday extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'albaqara',
        'alanam',
        'yaseen',
        'prayed_qiyam',
        'fasting',
        'day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
