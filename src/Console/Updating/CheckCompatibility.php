<?php
/**
 * @author      Peter Fox <peter.fox@peterfox.me>
 * @copyright   Peter Fox 2016
 *
 * @package     formally-app
 */

namespace Hexavel\Spark\Console\Updating;

use Laravel\Spark\Spark;

class CheckCompatibility
{
    protected static $version = '0.1.17';

    /**
     * The console command instance.
     *
     * @var \Illuminate\Console\Command  $command
     */
    protected $command;
    
    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Console\Command  $command
     */
    public function __construct($command)
    {
        $this->command = $command;
    }
    
    public function getSparkVersion()
    {
        return Spark::$version;
    }

    public function check($release)
    {
        $this->command->line('Lastest version found is <info>'.$release.'</info> 
        Current version is <info>'.$this->getSparkVersion().'</info>'.PHP_EOL);

        if ($this->supported($release)) {
            $this->command->line('Release '.$release.' is Hexavel compatible: <info>✔</info>');
            return true;
        }

        $this->command->line('<error>Version '.$release.' is not yet considered Hexavel compatible</error>'.PHP_EOL);
        $this->command->line('This <fg=red;options=bold;>might break your application</> but you can continue at your own risk. If you have not already, try updating Hexavel-Spark via \'composer update\'.');
        
        if (!$this->command->confirm(
            'Do you wish to still continue? [y|N]'
        )) {
            return false;
        }
        
        return true;
    }

    public function supported($release)
    {
        return version_compare(self::$version, $release, '>=');
    }
}