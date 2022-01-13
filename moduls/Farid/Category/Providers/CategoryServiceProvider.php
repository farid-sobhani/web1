<?php


namespace Farid\Category\Providers;


use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views' , 'Category');
        $this->loadRoutesFrom(__DIR__.'/../Route/category_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

    }

    public function boot()
    {
        config()->set('sidebar.items.category',[
            'icon' => 'i-categories',
            'url' => route('category.index'),
            'title' => 'دسته بندی ها',

        ]);

    }

}
