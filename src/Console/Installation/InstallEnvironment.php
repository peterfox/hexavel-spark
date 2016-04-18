<?php

namespace Hexavel\Spark\Console\Installation;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Laravel\Spark\Console\Installation\InstallEnvironment as BaseInstall;

class InstallEnvironment extends BaseInstall
{
    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        if (Str::contains(file_get_contents(base_path('.env')), 'AUTHY_SECRET')) {
            return;
        }

        (new Filesystem)->append(
            base_path('.env'), file_get_contents(SPARK_HEX_STUB_PATH.'/.env')
        );
    }
}
