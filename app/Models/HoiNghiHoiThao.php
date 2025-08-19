<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
class HoiNghiHoiThao extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'hoi_nghi_hoi_thao';

    //_id, ten, slug, mo_ta, noi_dung, photos, attachments, locale
}
