<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DuAn extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'du_an';

    /*
    _id
    ten_du_an
    co_quan_chu_tri
    don_vi_tai_tro
    can_bo_du_an
    thoi_gian_thuc_hien
    noi_dung_hoat_dong
    */
}
