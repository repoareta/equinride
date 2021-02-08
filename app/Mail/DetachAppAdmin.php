<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
 
class DetachAppAdmin extends Notification implements shouldQueue
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
            ->subject("Sorry, You're not the App Admin again")
            ->line("We're sorry, you're access has been detached");
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