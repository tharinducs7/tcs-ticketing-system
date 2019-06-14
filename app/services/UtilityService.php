<?php

namespace App\Services;
use Auth;
use App\Models\UserRolePermissions;
use App\Models\UserRoles;
use App\Models\Modules; 
use App\Models\Tickets; 
use Request;

class UtilityService
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }


    public function getCountTickets()
    {
        $Element= Tickets::count();
        return $Element;
    }

    
    public function getAccess($role_code,$module_code)
    {
        $Element= UserRolePermissions::where('role_code',$role_code)->where('module_code',$module_code)->first();
        return $Element;
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
 
    public function getAccessCreate($module_code)
    {
           if(Auth::user()){
            $module_code = Request::segment(1);
            $Permissions = UserRolePermissions::where('role_code',Auth::user()->role_code)->where('module_code',$module_code)->first();
             
            if(isset($Permissions)){
             if($Permissions->can_create==1){
                 $GrantPermission="Yes";
                 return $GrantPermission;;
               }
            }
            else{
                $GrantPermission="No";
                return $GrantPermission;;
            }
         }
    }

    public function getAccessView($module_code)
    {
           if(Auth::user()){
            $module_code = Request::segment(1);
            $Permissions = UserRolePermissions::where('role_code',Auth::user()->role_code)->where('module_code',$module_code)->first();
             
            if(isset($Permissions)){
             if($Permissions->can_read==1){
                 $GrantPermission="Yes";
                 return $GrantPermission;;
               }
            }
            else{
                $GrantPermission="No";
                return $GrantPermission;;
            }
         }
    }


    public function getAccessUpdate($module_code)
    {
           if(Auth::user()){
            $module_code = Request::segment(1);
            $Permissions = UserRolePermissions::where('role_code',Auth::user()->role_code)->where('module_code',$module_code)->first();
             
            if(isset($Permissions)){
             if($Permissions->can_update==1){
                 $GrantPermission="Yes";
                 return $GrantPermission;;
               }
            }
            else{
                $GrantPermission="No";
                return $GrantPermission;;
            }
         }
    }


    
}
