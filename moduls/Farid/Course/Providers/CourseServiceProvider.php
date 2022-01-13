<?php
namespace Farid\Course\Providers;
use Illuminate\Support\Facades\Gate;

use Database\Seeders\DatabaseSeeder;
use Farid\Course\Database\Seeds\RolePermissionTableSeeder;
use Illuminate\Support\ServiceProvider;
use Farid\Course\Models\Course;
use Farid\Course\Policies\CoursePolicy;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/seasons_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/lessons_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', "Courses");
        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;

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
