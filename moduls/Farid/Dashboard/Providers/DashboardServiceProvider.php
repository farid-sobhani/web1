<?php

namespace Farid\Dashboard\Providers;
use Illuminate\Support\ServiceProvider;
use Farid\RolePermissions\Models\Permission;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Dashboard');
        $this->mergeConfigFrom(__DIR__.'/../Config/sidebar.php','sidebar');

    }

    public function boot()
    {
        config()->set('sidebar.items.dashboard',[
            'icon' => 'i-dashboard',
            'url' => '/home',
            'title' => 'پیشخوان',
            'permission' => Permission::PERMISSION_TEACH
        ]);

    }

}
