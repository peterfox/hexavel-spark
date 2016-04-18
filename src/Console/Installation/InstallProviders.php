<?php

namespace Hexavel\Spark\Console\Installation;

use Laravel\Spark\Console\Installation\InstallProviders as BaseInstall;

class InstallProviders extends BaseInstall
{

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        copy(
            $this->getEventProvider(),
            app_path('Laravel/Providers/EventServiceProvider.php')
        );

        copy(
            SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/RouteServiceProvider.php',
            app_path('Laravel/Providers/RouteServiceProvider.php')
        );

        copy(
            $this->getSparkProvider(),
            $providerPath = app_path('Laravel/Providers/SparkServiceProvider.php')
        );
    }

    /**
     * Get the path to the proper event service provider.
     *
     * @return string
     */
    protected function getEventProvider()
    {
        return $this->command->option('braintree')
                        ? SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/BraintreeEventServiceProvider.php'
                        : SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/EventServiceProvider.php';
    }

    /**
     * Get the path to the proper Spark service provider.
     *
     * @return string
     */
    protected function getSparkProvider()
    {
        if ($this->command->option('braintree')) {
            return $this->getBraintreeSparkProvider();
        }

        return $this->command->option('team-billing')
                        ? SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/SparkTeamBillingServiceProvider.php'
                        : SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/SparkServiceProvider.php';
    }

    /**
     * Get the path to the proper Braintree Spark service provider.
     *
     * @return string
     */
    protected function getBraintreeSparkProvider()
    {
        return $this->command->option('team-billing')
                        ? SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/SparkBraintreeTeamBillingServiceProvider.php'
                        : SPARK_HEX_STUB_PATH.'/app/Laravel/Providers/SparkBraintreeServiceProvider.php';
    }
}
