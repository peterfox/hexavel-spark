<?php

namespace Hexavel\Spark\Console\Installation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

use Laravel\Spark\Console\Installation\InstallResources as BaseInstall;

class InstallResources extends BaseInstall
{
    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        $this->installFrontEndDirectories();

        $files = [
            SPARK_STUB_PATH.'/terms.md' => base_path('terms.md'),
            SPARK_HEX_STUB_PATH.'/gulpfile.js' => base_path('gulpfile.js'),
            SPARK_HEX_STUB_PATH.'/package.json' => base_path('package.json'),
            SPARK_HEX_STUB_PATH.'/resources/assets/less/app.less' => resource_path('assets/less/app.less'),
            SPARK_STUB_PATH.'/resources/lang/en/validation.php' => resource_path('lang/en/validation.php'),
            SPARK_STUB_PATH.'/resources/views/welcome.blade.php' => resource_path('views/welcome.blade.php'),
            SPARK_STUB_PATH.'/resources/views/home.blade.php' => resource_path('views/home.blade.php'),
        ];

        foreach ($files as $from => $to) {
            copy($from, $to);
        }

        (new Filesystem)->copyDirectory(
            SPARK_STUB_PATH.'/resources/assets/js', resource_path('assets/js')
        );

        Artisan::call('vendor:publish', ['--tag' => ['spark-views']]);
    }

    /**
     * Install the front-end directories.
     *
     * @return void
     */
    protected function installFrontEndDirectories()
    {
        (new Filesystem)->deleteDirectory(base_path('support/assets/sass'));

        if (!is_dir(resource_path('assets/js/components'))) {
            (new Filesystem)->makeDirectory(
                resource_path('assets/js/components'), $mode = 0755, $recursive = true
            );
        }

        if (!is_dir(resource_path('assets/js/spark-components'))) {
            (new Filesystem)->makeDirectory(
                resource_path('assets/js/spark-components'), $mode = 0755, $recursive = true
            );
        }

        if (!is_dir(resource_path('assets/less'))) {
            (new Filesystem)->makeDirectory(resource_path('assets/less'));
        }
    }
}
