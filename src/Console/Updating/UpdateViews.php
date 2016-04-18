<?php

namespace Hexavel\Spark\Console\Updating;

use Illuminate\Filesystem\Filesystem;

use Laravel\Spark\Console\Updating\UpdateViews as BaseUpdate;

class UpdateViews extends BaseUpdate
{

    /**
     * Update the components.
     *
     * @return void
     */
    public function update()
    {
        $this->viewsThatHaveBeenPublished()->each(function ($view) {
            $this->viewIsUnchanged($view)
                            ? $this->updateView($view)
                            : $this->showModifiedNotification($view);
        });

        $this->installNewViews();
    }

    /**
     * Get the fully qualified path to the published view.
     *
     * @param  \SplFileInfo  $view
     * @return string
     */
    protected function publishedViewPath($view)
    {
        return base_path('support/resources/views/vendor/spark/'.$this->relativeViewPath($view));
    }

    /**
     * Get the view path relative to the views directory.
     *
     * @param  \SplFileInfo  $view
     * @return string
     */
    protected function relativeViewPath($view)
    {
        $viewPath = str_replace(realpath(SPARK_PATH.'/resources/views/'), '', $view->getRealPath());

        return str_replace(realpath($this->downloadPath.'/resources/views/'), '', $viewPath);
    }
}
