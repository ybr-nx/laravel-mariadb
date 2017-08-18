# laravel-mariadb
Add MariaDB JSON support to Laravel. Requires at least MariaDB 10.2 (and 10.2.7 to use ->json() migrations)

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

##### Migration
Adds needed validation to json fields during migrations
```php
$table->json('field') //CHECK (JSON_VALID(field))
$table->json('field')->nullable() //CHECK (field IS NULL OR JSON_VALID(field))
```    

##### Query builder
Builds json select statements to work with MariaDB
```php
$query->where('somejson->something->somethingelse', 2)
DB::table('sometable')->select('sometable.somedata', 'sometable.somejson->somedata as somejsondata')
```

**NB** There is difference between MySQL and MariaDB behaviour in JSON_EXTRACT() function. 
It should be fixed in MariaDB 10.2.8: https://jira.mariadb.org/browse/MDEV-12604
```php
$query->where('somejson->something->somethingelse', '"somedata"') //works with string in MariaDB
$query->where('somejson->something->somethingelse', 'somedata') //works with string in MySQL
```
