<?php

namespace Hexavel\Spark\Console\Commands;

use Laravel\Spark\Console\Commands\InstallCommand as BaseCommand;
use Laravel\Spark\Console\Installation as BaseInstallation;

use Hexavel\Spark\Console\Installation;

class InstallCommand extends BaseCommand
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Spark scaffolding into the application (Hexavel Modified)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! defined('SPARK_STUB_PATH')) {
            define('SPARK_STUB_PATH', SPARK_PATH.'/install-stubs');
        }

        if (! defined('SPARK_HEX_STUB_PATH')) {
            define('SPARK_HEX_STUB_PATH', realpath(__DIR__.'/../../../install-stubs'));
        }

        if ($this->sparkAlreadyInstalled() && ! $this->option('force')) {
            return $this->line('Spark (Hexavel Modified) is already installed for this project.');
        }

        $installers = collect([
            Installation\InstallConfiguration::class,
            Installation\InstallEnvironment::class,
            Installation\InstallHttp::class,
            BaseInstallation\InstallImages::class,
            BaseInstallation\InstallMigrations::class,
            Installation\InstallModels::class,
            Installation\InstallProviders::class,
            Installation\InstallResources::class,
        ]);

        $installers->each(function ($installer) { (new $installer($this))->install(); });

        $this->comment('Laravel Spark (Hexavel Modified) installed. Create something amazing!');
    }

    /**
     * Determine if Spark is already installed.
     *
     * @return bool
     */
    protected function sparkAlreadyInstalled()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        return isset($composer['require']['laravel/spark']);
    }
}
