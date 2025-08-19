<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model; 
// lỗi Call to a member function prepare() on null khi thiếu dòng này
use MongoDB\Laravel\Eloquent\Model as Eloquent;
class NganhDaoTao extends Eloquent
{
    use HasFactory;
     protected $connection = 'mongodb';
    protected $collection = 'nganh_dao_tao';
     //_id, tennganh, slug, noidung, photo, file, tags
}
