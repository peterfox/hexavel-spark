<?php

namespace Hexavel\Spark\Console\Installation;

use Laravel\Spark\Console\Installation\InstallModels as BaseInstall;

class InstallModels extends BaseInstall
{

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        copy($this->getUserModel(), app_path('Bridge/Eloquent/Model/User.php'));

        copy(SPARK_HEX_STUB_PATH.'/app/Bridge/Eloquent/Model/Team.php', app_path('Bridge/Eloquent/Model/Team.php'));
    }

    /**
     * Get the path to the proper User model stub.
     *
     * @return string
     */
    protected function getUserModel()
    {
        return $this->command->option('team-billing')
                            ? SPARK_HEX_STUB_PATH.'/app/Bridge/Eloquent/Model/TeamUser.php'
                            : SPARK_HEX_STUB_PATH.'/app/Bridge/Eloquent/Model/User.php';
    }
}
