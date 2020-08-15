<?php

namespace App\Providers;

use App\Domain\User\Models\User;
use App\Domain\Master\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        setLocale(LC_TIME,config('app.locale'));

        Gate::before(function (User $user) {
            if ($user->hasRole([Role::ADMIN, Role::DIREKTUR])) {
                return true;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
