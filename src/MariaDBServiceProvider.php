<?php

namespace YbrNX\MariaDB;

use Illuminate\Support\ServiceProvider;

class MariaDBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $app = $this->app;

        $app['db']->extend('mariadb', function ($config) use ($app) {
            return (new ConnectionFactory($app))->make($config);
        });
    }
}
