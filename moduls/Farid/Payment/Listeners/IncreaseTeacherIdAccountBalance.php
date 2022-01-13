<?php

namespace Farid\Payment\Listeners;


use Farid\Course\Models\Course;
use Farid\Payment\Repositories\PaymentRepo;

class IncreaseTeacherIdAccountBalance
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $course = Course::find($event->payment->paymentable_id);
        $teacher = $course->teacher;
        $teacher->balance += $event->payment->seller_share;
        $teacher->save();


    }
}
