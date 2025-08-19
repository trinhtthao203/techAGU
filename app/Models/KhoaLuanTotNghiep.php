<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
class KhoaLuanTotNghiep extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'khoa_luan_tot_nghiep';

    protected $dates = ['thoi_gian_bat_dau', 'thoi_gian_ket_thuc'];
    /*
    _id
    ten_de_tai
    ten_sinh_vien
    so_trang
    tom_tat
    tu_khoa
    locale
    */
}
