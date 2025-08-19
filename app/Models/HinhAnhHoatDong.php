<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
class HinhAnhHoatDong extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'hinh_anh_hoat_dong';
    //_id, photos, url
}