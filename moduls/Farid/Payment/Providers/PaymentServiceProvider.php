<?php

namespace Farid\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Farid\Payment\Gateways\Gateway;
use Farid\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
use Farid\Payment\Models\Payment;
use Farid\Payment\Policies\PaymentPolicy;
use Farid\RolePermissions\Models\Permission;

class PaymentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/payment_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/settlement_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Payment');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
    }

    public function boot()
    {
//        \Gate::policy(Payment::class,PaymentPolicy::class);
        config()->set('sidebar.items.transactions', [
            "icon" => "i-transactions",
            "title" => "تراکنش ها",
            "url" => 'payments'
        ]);
        config()->set('sidebar.items.my-purchases', [
            "icon" => "i-my__purchases",
            "title" => "خریدهای من",
            "url" => '/mypurchases',
        ]);
        config()->set('sidebar.items.settlement-request', [
            "icon" => "i-checkout__request",
            "title" => "درخواست تسویه حساب",
            "url" => route('settlements.create'),
        ]);
        config()->set('sidebar.items.settlements', [
            "icon" => "i-checkouts",
            "title" => "تسویه حساب ها",
            "url" => route('settlements.index'),
        ]);
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });
    }
}
