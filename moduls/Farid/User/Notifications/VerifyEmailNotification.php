<?php

namespace Farid\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Farid\User\Mail\VerifyCodeMail;
use Farid\User\Services\VerifyCodeService;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VerifyCodeMail
     */
    public function toMail($notifiable)
    {

        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id,$code);

        return (new VerifyCodeMail($code))->to($notifiable->email)->subject('سیویل وب | کد فعال سازی ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
