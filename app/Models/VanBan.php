<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class VanBan extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'van_ban';

    //_id, title, description, cat, attachtments
}
