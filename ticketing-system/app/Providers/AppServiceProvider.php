<?php

namespace App\Providers;
use Auth;
use App\Models\UserRolePermissions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
       /*  $permissions = UserRolePermissions::where('role_code',Auth::user()->role_code)->get();
           view()->share('permissions', $permissions); */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
