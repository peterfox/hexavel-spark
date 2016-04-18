<?php

namespace Hexavel\Spark\Console\Updating;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Laravel\Spark\Console\Updating\RemoveDownloadPath as BaseUpdate;

class RemoveDownloadPath extends BaseUpdate
{
    /**
     * Update the components.
     *
     * @return void
     */
    public function update()
    {
        (new Filesystem)->deleteDirectory(base_path('var/spark-new'));
    }
}
