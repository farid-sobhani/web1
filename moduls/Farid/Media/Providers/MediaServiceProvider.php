<?php

namespace Farid\Media\Providers;
use \Illuminate\Support\ServiceProvider;


class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
//        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', "Courses");
//        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
        $this->mergeConfigFrom(__DIR__ . '/../Config/mediaFile.php','mediaFile');
    }

    public function boot()
    {
        config()->set('sidebar.items.courses', [
            "icon" => "i-courses",
            "title" => "دوره ها",
            "url" => route('courses.index')
        ]);
    }

}
