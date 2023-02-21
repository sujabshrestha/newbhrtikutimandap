<?php

namespace Venue\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use User\Repositories\User\UserInterface;
use User\Repositories\User\UserRepository;
use User\Repositories\Package\PackageInterface;
use User\Repositories\Package\PackageRepository;
use User\Repositories\Role\RoleInterface;
use User\Repositories\Role\RoleRepository;
use User\Repositories\Permission\PermissionInterface;
use User\Repositories\Permission\PermissionRepository;
use Venue\Repositories\VenueInterface;
use Venue\Repositories\VenueRepository;

class VenueServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(VenueInterface::class, VenueRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $moduleName="Venue";
        config([
            'venueRoute' => File::getRequire(loadConfig('route.php', $moduleName)),
            // 'companyImage' => File::getRequire(loadConfig('imageResize.php', $moduleName)),
        ]);
        $this->loadRoutesFrom(loadRoutes('admin.php', $moduleName));
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        $this->loadViewsFrom(loadViews($moduleName), $moduleName);

    }
}
