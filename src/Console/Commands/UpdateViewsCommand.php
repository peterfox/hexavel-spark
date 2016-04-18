<?php

namespace Hexavel\Spark\Console\Commands;

use Laravel\Spark\Console\Commands\UpdateViewsCommand as BaseCommand;
use Hexavel\Spark\Console\Updating;

class UpdateViewsCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spark:update-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Spark views (Hexavel Modified)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $updaters = collect([
            Updating\UpdateViews::class,
        ]);

        $updaters->each(function ($updater) {
            (new $updater($this, SPARK_PATH))->update();
        });
    }
}
