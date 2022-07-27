<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "user_id",'message','book_id','start'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];
}
