<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ErrorAdNotification extends Notification
{
    use Queueable;

    public $user;
    public $ad;
    public $moderatingAd;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $ad, $moderatingAd)
    {
        $this->user = $user;
        $this->ad = $ad;
        $this->moderatingAd = $moderatingAd;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->user->name)
                    ->line('You ad"'.$this->ad->title.'"was rejected for a reason"'.$this->moderatingAd->why.'"');
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
