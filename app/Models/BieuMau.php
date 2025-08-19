<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class BieuMau extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'bieu_mau';

    //_id, title, description, cat, attachtments
}
