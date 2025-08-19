<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DoiTac extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'doi_tac';

    //_id, ten, slug, mo_ta, noi_dung, photos
}
