<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
class TranslatePath extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'translate_path';

    //_id, id_vi, slug_vi, id_en, slug_en, id_ja, slug_ja, collection, id_user

}
