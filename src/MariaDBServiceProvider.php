<?php

namespace YbrNX\MariaDB;

use Illuminate\Support\ServiceProvider;

class MariaDBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->resolving('db', function ($db, $app) {
            $db->extend('mariadb', function ($config, $name) use ($app){
                return (new ConnectionFactory($app))->make($config, $name);
            });
        });
    }
}
