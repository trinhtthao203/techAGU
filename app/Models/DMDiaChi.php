<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DMDiaChi extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'dm_diachi';
}
