<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFaker();
    }
    /**
     * Register the faker generator class.
     *
     * @return void
     */
    protected function registerFaker()
    {
        $this->app->singleton(Generator::class, function () {
            return Factory::create('id_ID');
        });
    }
}