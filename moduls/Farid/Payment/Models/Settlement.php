<?php

namespace Farid\Payment\Models;

use Farid\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $guarded = [];
    const STATUS_PENDING = "pending";
    const STATUS_SETTLED = "settled";
    const STATUS_REJECTED = "rejected";


    public static $statues = [
        self::STATUS_PENDING,
        self::STATUS_SETTLED,
        self::STATUS_REJECTED,
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
