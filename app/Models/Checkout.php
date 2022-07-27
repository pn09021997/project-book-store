<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "status",'user_id','price','message'
    ];
        protected $casts = [
            'created_at' => 'datetime',
        ];

}
