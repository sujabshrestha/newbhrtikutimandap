<?php

namespace CMS\Providers;

use CMS\Repositories\CMSInterface;
use CMS\Repositories\CMSRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;


class CMSServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {

        $this->app->bind(CMSInterface::class,CMSRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $moduleName="CMS";
        config([
            'cmsRoute' => File::getRequire(loadConfig('route.php', $moduleName)),
        ]);
        $this->loadRoutesFrom(loadRoutes('admin.php', $moduleName));
        $this->loadRoutesFrom(loadRoutes('api.php', $moduleName));
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        $this->loadViewsFrom(loadViews($moduleName), $moduleName);

    }
}
