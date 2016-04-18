<?php

namespace Hexavel\Spark\Console\Installation;

use Laravel\Spark\Console\Installation\InstallHttp as BaseInstall;

use Illuminate\Filesystem\Filesystem;

class InstallHttp extends BaseInstall
{
    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        (new Filesystem)->copyDirectory(SPARK_HEX_STUB_PATH.'/app/Laravel/Http', app_path('Laravel/Http'));
    }
}
