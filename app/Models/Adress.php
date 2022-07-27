<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'city_province', 'district', 'wards',
    ];
    protected $table = 'dia_chi_giao_hang';


}
