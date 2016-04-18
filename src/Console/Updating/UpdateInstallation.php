<?php

namespace Hexavel\Spark\Console\Updating;

use Exception;
use Illuminate\Filesystem\Filesystem;

use Laravel\Spark\Console\Updating\UpdateInstallation as BaseUpdate;

class UpdateInstallation extends BaseUpdate
{
    /**
     * The path to the downloaded Spark upgrade.
     *
     * @var string
     */
    protected $downloadPath;

    /**
     * Update the components.
     *
     * @return void
     */
    public function update()
    {
        (new Filesystem)->deleteDirectory(base_path('support/packages/spark'));

        rename($this->downloadPath, SPARK_PATH);
    }
}
