<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class normalNotification extends Notification
{
    use Queueable;






    protected $message;
    public function __construct($message)
    {
        $this->message=$message;
    }









    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(){
        return [

            'title'=>$this->message['title'],
            'message'=>$this->message['message']
        ];

    }

     public function toMail($notifiable)
     {
//         return (new MailMessage)
//                     ->line('The introduction to the notification.')
//                     ->action('Notification Action', url('/'))
//                     ->line('Thank you for using our application!');
     }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
