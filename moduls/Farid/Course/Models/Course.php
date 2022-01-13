<?php

namespace Farid\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Farid\Media\Models\Media;
use Farid\User\Models\User;

class Course extends Model
{
    protected $guarded = [];

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];


    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];



    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function banner()
    {
        return $this->hasOne(Media::class, 'id', 'banner_id');

    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);

    }

    public function getDuration()
    {
        return gmdate("H:i:s",$this->lessons()->newQuery()->select('time')->sum('time')*60);
    }

    public function student()
    {
        return $this->belongsToMany(User::class,'course_student','course_id','user_id');
    }
    public function getFinalPrice()
    {
        return $this->price - $this->getDiscountAmount();
    }
    public function getDiscountAmount()
    {
        // todo
        return 0;
    }

}
