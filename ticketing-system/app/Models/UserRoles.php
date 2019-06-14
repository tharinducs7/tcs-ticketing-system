<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //protected $table = 'departments';
  
    protected $fillable = [
        'name',
        'code',
        'active',
        'updated_at',
        'created_at'
    ];

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
    ];

    public $timestamps = true;
}



