<?php

namespace Hexavel\Spark\Providers;

use Laravel\Spark\Spark;
use Illuminate\Support\Facades\Route;
use Hexavel\Spark\Console\Commands\InstallCommand;
use Hexavel\Spark\Console\Commands\UpdateCommand;
use Hexavel\Spark\Console\Commands\VersionCommand;
use Hexavel\Spark\Console\Commands\UpdateViewsCommand;
use Laravel\Spark\Console\Commands\StorePerformanceIndicatorsCommand;

use Laravel\Spark\Providers\SparkServiceProvider as BaseProvider;

class SparkServiceProvider extends BaseProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('SPARK_PATH')) {
            define('SPARK_PATH', base_path('support/packages/spark'));
        }

        if (! class_exists('Spark')) {
            class_alias('Laravel\Spark\Spark', 'Spark');
        }

        Spark::useUserModel('App\Bridge\Eloquent\Model\User');
        Spark::useTeamModel('App\Bridge\Eloquent\Model\Team');


        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UpdateCommand::class,
                UpdateViewsCommand::class,
                StorePerformanceIndicatorsCommand::class,
                VersionCommand::class,
            ]);
        }

        $this->registerServices();
    }

    /**
     * Register a view file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadViewsFrom($path, $namespace)
    {
        if (is_dir($appPath = $this->app->basePath().'/support/resources/views/vendor/'.$namespace)) {
            $this->app['view']->addNamespace($namespace, $appPath);
        }

        $this->app['view']->addNamespace($namespace, $path);
    }
}
