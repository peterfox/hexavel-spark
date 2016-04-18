<?php

namespace Hexavel\Spark\Console\Commands;

use Exception;
use Laravel\Spark\Spark;
use Hexavel\Spark\Console\Updating;
use Laravel\Spark\Console\Commands\UpdateCommand as BaseCommand;

class UpdateCommand extends BaseCommand
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Spark installation (Hexavel Modified)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->onLatestRelease()) {
            return $this->info('You are already running the latest release of Spark.');
        }

        $continue = (new Updating\CheckCompatibility($this))->check(
            $release = $this->latestSparkRelease()
        );

        if (!$continue) {
            return $this->warn('Spark upgrade aborted!');
        }
        
        $downloadPath = (new Updating\DownloadRelease($this))->download($release);
        
        $updaters = collect([
            Updating\UpdateViews::class,
            Updating\UpdateInstallation::class,
            Updating\RemoveDownloadPath::class,
        ]);

        $updaters->each(function ($updater) use ($downloadPath) {
            (new $updater($this, $downloadPath))->update();
        });

        $this->info('You are now running on Spark v'.$release.' (Hexavel Modified). Enjoy!');
    }
}
