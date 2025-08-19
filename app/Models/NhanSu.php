<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
class NhanSu extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'nhan_su';

    //_id, ho_ten, chuc_vu, dien_thoai, email, mo_ta, tags [nhan-su, chuyen-gia], locale, thu_tu

}
