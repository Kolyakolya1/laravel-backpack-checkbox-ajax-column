<?php
namespace inf1111\CheckboxAjax;

use Illuminate\Support\ServiceProvider;

class CheckboxAjaxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'CheckboxAjax');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('inf1111\CheckboxAjax\CheckboxAjaxController');
    }
}
