<?php


namespace Farid\Payment\Providers;


use App\Providers\EventServiceProvider as ServiceProvider;
use Farid\Payment\Event\PaymentWasSuccessFull;
use Farid\Course\Listeners\RegisterUserInCourse;
use Farid\Payment\Listeners\IncreaseTeacherIdAccountBalance;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessFull::class =>
            [
                RegisterUserInCourse::class,
                IncreaseTeacherIdAccountBalance::class,
            ]
    ];


    public function boot()
    {
        parent::boot();

        //
    }
}
