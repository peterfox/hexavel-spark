<?php

namespace Hexavel\Spark\Console\Updating;

use Exception;
use ZipArchive;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Filesystem\Filesystem;
use GuzzleHttp\Exception\ClientException;
use Laravel\Spark\Console\Updating\DownloadRelease as BaseUpdate;

class DownloadRelease extends BaseUpdate
{
    /**
     * Download the latest Spark release.
     *
     * @param  string  $release
     * @return string
     */
    public function download($release)
    {
        file_put_contents(
            $zipPath = base_path('var/spark-archive.zip'), $this->zipResponse($release)
        );

        $this->extractZip($zipPath);

        return $this->releasePath();
    }

    /**
     * Get the raw Zip response for the given release.
     *
     * @param  string  $release
     * @return string
     */
    protected function zipResponse($release)
    {
        try {
            return (string) (new HttpClient)->get(
                $this->sparkUrl.'/api/releases/'.$release.'/download?api_token='.$this->readToken(),
                ['headers' => [
                    'X-Requested-With' => 'XMLHttpRequest',
                ]]
            )->getBody();
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 401) {
                $this->invalidLicense($release);
            }

            throw $e;
        }
    }

    /**
     * Extract the Spark Zip archive.
     *
     * @param  string  $zipPath
     * @return void
     */
    protected function extractZip($zipPath)
    {
        $archive = new ZipArchive;

        $archive->open($zipPath);

        $archive->extractTo(base_path('var/spark-new'));

        $archive->close();

        @unlink($zipPath);
    }

    /**
     * Get the release directory.
     *
     * @return string
     */
    protected function releasePath()
    {
        return base_path('var/spark-new/'.basename(
            (new Filesystem)->directories(base_path('var/spark-new'))[0]
        ));
    }

    /**
     * Inform the user that their Spark license is invalid.
     *
     * @return void
     */
    protected function invalidLicense($release)
    {
        $this->command->line(
            '<fg=red>You do not own any licenses for release ['.$release.'].</>'
        );

        exit(1);
    }
}
