<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
 
class AttachNewAppAdmin extends Notification implements shouldQueue
{
    use Queueable;
    // public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($data)
    // {
    //     $this->data = $data;
    // }

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
        // $data = $this->data;
        return (new MailMessage)
            ->subject("Now, You're the App Admin")
            ->line('Congratulation! You are the app admin now.');
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