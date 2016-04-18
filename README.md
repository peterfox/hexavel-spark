# Hexavel Spark

Hexavel Spark is a simple compatibility library designed to work with [Laravel Spark](http://spark.laravel.com) and 
the [Hexavel version of Laravel](https://github.com/peterfox/hexavel). This library still requires you to buy a license
for Spark and is useless with out one.

### Install

First create a Hexavel project per [the instructions](https://github.com/peterfox/hexavel/blob/master/README.md) and then
download a copy of Spark and paste it into the ```support/packages``` directory of the project. You can then modify composer.json
with

```
    "repositories": [
            {
                "type": "path",
                "url": "./support/packages/spark"
            }
    ]        
```

Then run:

```
composer require laravel/cashier 
composer require laravel/spark 
composer require hexavel/spark 
```

Then add the Hexavel Spark provider to the ```config/app.php``` e.g.
 
```
/*
 * Application Service Providers...
 */
Hexavel\Spark\Providers\SparkServiceProvider::class,
Laravel\Cashier\CashierServiceProvider::class,
```

If you then run ```bin/artisan``` you should see the new spark commands added, they should also say (Hexavel Modified) 
in the description.

You should then simply be able to run ```bin/artisan spark:install --force``` or ```bin/artisan spark:install  --team-billing --force```
and have the stubs for Spark installed in the correction positions for Hexavel.

Afterwards you just need to add the newly installed SparkServiceProvider.

```
/*
 * Application Service Providers...
 */
Hexavel\Spark\Providers\SparkServiceProvider::class,
Laravel\Cashier\CashierServiceProvider::class,
App\Laravel\Providers\SparkServiceProvider::class, // App Spark Provider
```

### Update

To upgrade you should first run ```composer update``` to check for a new version of Hexavel Spark you can then update 
Spark the same way for Hexavel as Laravel via ``` bin/artisan spark:update```. The main difference with Hexavel is you 
will be warned if we're yet to check the compatibility of the library with Spark. For the most part it shouldn't be an 
issue but this can't always be guaranteed. 
