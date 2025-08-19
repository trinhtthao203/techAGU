<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
class TinTucSuKien extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'tin_tuc_su_kien';

    //_id, title, slug, description, contents, photos, attachments

    protected $dates = ['date_post'];
}
