<?php

namespace Hexavel\Spark\Console\Installation;

use Laravel\Spark\Console\Installation\InstallConfiguration as BaseInstall;

class InstallConfiguration extends BaseInstall
{
    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        copy(SPARK_HEX_STUB_PATH.'/config/auth.php', config_path('auth.php'));

        copy(SPARK_HEX_STUB_PATH.'/routes.php', base_path('app/routes.php'));
        copy(SPARK_HEX_STUB_PATH.'/api.php', base_path('app/api.php'));

        copy(SPARK_HEX_STUB_PATH.'/config/'.$this->servicesFile().'.php', config_path('services.php'));
    }
}
