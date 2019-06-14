<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    //protected $table = 'departments';
  
    protected $fillable = [
        'title',
        'description',
        'client_id',
        'type',
        'priority',
        'status',
        'updated_at',
        'created_at',
        'image'
    ];

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'client_id' => 'required',
    ];

    public $timestamps = true;
}



