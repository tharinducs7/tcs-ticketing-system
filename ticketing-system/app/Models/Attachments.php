<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{

    protected $fillable = [
        'title_id',
        'type',
        'attachment',
        'created_at',
        'updated_at',
    ];

  
}
