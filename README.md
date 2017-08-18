# laravel-mariadb
Add MariaDB JSON support to Laravel. Requires at least MariaDB 10.2. 

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
#### Added functionality
##### Query builder
Builds json select statements to work with MariaDB
```php
$query->where('somejson->something->somethingelse', 2)... //integer value
$query->where('somejson->something->somethingelse', '"somedata"')... //string value
DB::table('sometable')->select('sometable.somedata', 'sometable.somejson->somedata as somejsondata')
```
##### Migration
Adds needed validation to json fields during migrations
```php
$table->json('field') //CHECK (JSON_VALID(field))
$table->json('field')->nullable() //CHECK (field IS NULL OR JSON_VALID(field))
```    