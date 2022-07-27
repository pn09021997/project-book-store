<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Support extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'cart_id','product_id','quantity','price'
    ];

}
