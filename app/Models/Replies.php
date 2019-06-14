<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    //protected $table = 'departments';
  
    protected $fillable = [
        'ticket_id',
        'description',
        'reply_by',
        'updated_at',
        'created_at',
        'moved_to',
        'moved_from',
        'priority'
    ];

    public $timestamps = true;
}



