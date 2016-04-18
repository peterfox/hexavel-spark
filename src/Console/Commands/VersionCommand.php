<?php

namespace Hexavel\Spark\Console\Commands;

use Exception;
use Laravel\Spark\Spark;

use Laravel\Spark\Console\Commands\VersionCommand as BaseCommand;

class VersionCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spark:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View the current Spark version (Hexavel Modified)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('<info>Laravel Spark</info> version <comment>'.Spark::$version.' (Hexavel Edition)</comment>');
    }
}
