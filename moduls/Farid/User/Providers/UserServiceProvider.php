<?php


namespace Farid\User\Providers;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Farid\User\Database\Seeds\UserSeeder;
use Farid\User\Models\User;
use Farid\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function boot()

    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        Gate::policy(User::class,UserPolicy::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class;
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "title" => "کاربران",
            "url" => route('user.index')
        ]);

    }

    public function register()
    {
        config()->set('auth.providers.users.model',User::class);
        // $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');



        //dd(config()->get('auth.providers.users.model'));
    }

}
