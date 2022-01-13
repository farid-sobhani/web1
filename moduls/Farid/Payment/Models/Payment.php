<?php
namespace Farid\Payment\Models;

use Farid\Course\Models\Course;
use Farid\User\Models\User;

class Payment extends \Illuminate\Database\Eloquent\Model {
    protected $guarded = [];
    const STATUS_PENDING = "pending";
    const STATUS_canceled = "canceled";
    const STATUS_SUCCESS = "success";
    const STATUS_FAIL = "fail";
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_canceled,
        self::STATUS_SUCCESS,
        self::STATUS_FAIL,
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'paymentable_id','id');
    }
}
