<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'category';

    //_id, title, description, cat, attachtments
}