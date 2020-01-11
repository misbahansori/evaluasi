<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Domain\Pegawai\Models\Pegawai' => 'App\Domain\Pegawai\Policies\PegawaiPolicy',
        'App\Domain\Penilaian\Models\Catatan' => 'App\Domain\Penilaian\Policies\CatatanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('login-as', function($user) {
            return in_array($user->email, [
                'misbah.ansori24@gmail.com'
            ]);
        });
    }
}
