<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class NghienCuuKhoaHoc extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'nghien_cuu_khoa_hoc';

    protected $dates = ['thoi_gian_bat_dau', 'thoi_gian_ket_thuc'];
    /*
    _id
    ma_so_nhiem_vu
    so_dang_ky_ket_qua
    ten_nhiem_vu
    to_chuc_chu_tri
    co_quan_chu_quan
    cap_quan_ly
    chu_nhiem_nhiem_vu
    cac_thanh_vien_tham_gia
    linh_vuc_nghien_cuu
    thoi_gian_bat_dau
    thoi_gian_ket_thuc
    so_trang
    tom_tat
    tu_khoa
    locale
    */
}
