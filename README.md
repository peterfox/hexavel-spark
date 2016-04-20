# Hexavel Spark

Hexavel Spark is a simple compatibility library designed to work with [Laravel Spark](http://spark.laravel.com) and 
the [Hexavel version of Laravel](https://github.com/peterfox/hexavel). This library still requires you to buy a license
for Spark and is useless with out one.

### Support

This package is purely supported by myself [Peter Fox](mailto:peter.fox@peterfox.me) and using it could throw up issues
which isn't covered by Spark itself due to the nature of using a different folder structure to Laravel as well as an
off shoots of Laravel Elixir made for Hexavel. 

Hexavel has never been meant for beginner users and you shouldn't use Hexavel unless you're sure of what you're doing.

### Install

First create a Hexavel project per [the instructions](https://github.com/peterfox/hexavel/blob/master/README.md) and then
download a copy of Spark and paste it into the ```support/packages``` directory of the project. You can then modify composer.json
with

```json
    "repositories": [
            {
                "type": "path",
                "url": "./support/packages/spark"
            }
    ]        
```

Then run:

```ssh
composer require laravel/cashier 
composer require laravel/spark:*@dev
composer require hexavel/spark 
```

Then add the Hexavel Spark provider to the ```config/app.php``` e.g.
 
```php
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

```php
/*
 * Application Service Providers...
 */
Hexavel\Spark\Providers\SparkServiceProvider::class,
Laravel\Cashier\CashierServiceProvider::class,
App\Laravel\Providers\SparkServiceProvider::class, // App Spark Provider
```

Then the final step to a fully working Spark/Hexavel Project is to run ```npm install``` and then ```gulp``` to build
all the javascript and less assets as well as ```bin/artisan migrate``` to install the database tables.

### Update

To upgrade you should first run ```composer update``` to check for a new version of Hexavel Spark you can then update 
Spark the same way for Hexavel as Laravel via ``` bin/artisan spark:update```. The main difference with Hexavel is you 
will be warned if we're yet to check the compatibility of the library with Spark. For the most part it shouldn't be an 
issue but this can't always be guaranteed. 
