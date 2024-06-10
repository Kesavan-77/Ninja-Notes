<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowNotification extends Notification
{
    use Queueable;
    public $userName;
    public $message;
    public $userId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userId, $userName,$message)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'user_id'=>$this->userId,
            'name'=>$this->userName,
            'message'=>$this->message,
        ];
    }
}
