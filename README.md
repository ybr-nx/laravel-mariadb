# laravel-mariadb
Add MariaDB JSON select support to Laravel

#### Install
Using composer:
```
$ composer require ybr-nx/laravel-mariadb
```

#### Configure
Include MariaDBServiceProvider in your config/app.php:

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    YbrNX\MariaDB\MariaDBServiceProvider::class,
]
```

set **driver** in database configuration to **mariadb**
```php
'defaultconnection' => [
    'driver' => 'mariadb',
```
and that's all

