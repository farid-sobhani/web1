<?php

namespace Farid\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Farid\Course\Models\Course;
use Farid\Course\Models\Season;
use Farid\Media\Models\Media;
use Farid\Payment\Models\Payment;
use Farid\RolePermissions\Models\Permission;
use Farid\RolePermissions\Models\Role;
use Farid\User\Notifications\ResetPasswordNotification;
use Farid\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordNotification()
    {
        $this->notify(new ResetPasswordNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');

    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function hasAccessToCourse(Course $course)
    {
        if ($this->can(Permission::PERMISSION_MANAGE_COURSES, Course::class) ||
            $this->id === $course->teacher_id ||
            $course->student->contains($this->id)
        ) return true;
        return false;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_student','user_id','course_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'buyer_id','id');
    }

    public function balance()
    {
        return $this->balance;
    }


}
