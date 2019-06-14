<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    //protected $table = 'departments';
  
    protected $fillable = [
        'md_name',
        'md_code',
        'active',
        'url',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'updated_at',
        'created_at'
    ];

    protected $rules = [
        'md_name' => 'required',
        'md_code' => 'required',
    ];

    public $timestamps = true;
}



