<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StableCreatedNotificationToAppOwnerAdmin extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    private $stable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($stable)
    {
        $this->stable = $stable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
                ->line('New stable has been created, please review immediately.')
                ->action('Notification Action', url('/'))
                ->line('Thank you for using our application!');
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
            'message' => 'New stable has been created',
            'data' => $this->stable
        ];
    }

    /**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => "$this->stable (Stable $notifiable->id)"
        ]);
    }
}
