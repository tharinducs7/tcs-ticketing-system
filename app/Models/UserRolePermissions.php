<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRolePermissions extends Model
{
    //protected $table = 'departments';
  
    protected $fillable = [
        'role_code',
        'module_code',
        'is_enable',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'updated_at',
        'created_at'
    ];

    protected $rules = [
        'module_code' => 'required',
        'role_code' => 'required',
        
    ];

    public $timestamps = true;
}



