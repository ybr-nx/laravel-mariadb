# laravel-mariadb
Add MariaDB JSON support to Laravel. 
Requires at least MariaDB 10.2.3 (and 10.2.7 to use ->json() migrations)

#### Install
Using composer:
```
$ composer require ybr-nx/laravel-mariadb
```

#### Configure (only Larvel 5.3 and 5.4)
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
And also JSON_SET() works in MariaDB as in MySQL 5.7
```php
DB::table('sometable')->where('somejson->somedata', $id)->update(['somejson->otherdata' => 'newvalue']);
```

**NB** There is bug in **MariaDB < 10.2.8** JSON_EXTRACT() behaviour function. 
It's fixed in MariaDB 10.2.8: https://jira.mariadb.org/browse/MDEV-12604
```php
//works with string in MySQL & MariaDB 10.2.8
$query->where('somejson->something->somethingelse', 'somedata')

//works with string in MariaDB < 10.2.8
$query->where('somejson->something->somethingelse', '"somedata"') 
```
