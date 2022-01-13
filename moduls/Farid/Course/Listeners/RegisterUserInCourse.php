<?php

namespace Farid\Course\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Farid\Course\Models\Course;
use Farid\Course\Repositories\CourseRepo;

class RegisterUserInCourse
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
        if ($event->payment->paymentable_type == Course::class) {
            resolve(CourseRepo::class)
                ->registerStudentToCourse($event->payment->buyer_id,$event->payment->paymentable_id);
        }
    }
}
