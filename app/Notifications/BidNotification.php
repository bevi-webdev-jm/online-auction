<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidNotification extends Notification
{
    use Queueable;

    public $bidding;

    /**
     * Create a new notification instance.
     */
    public function __construct($bidding)
    {
        $this->bidding = $bidding;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('notify@bevi.com.ph', 'ONLINE AUCTION')
            ->subject('You have placed yout bid!.')
            ->greeting('Hello! '.$notifiable->name)
            ->line('You have successfully placed your '.number_format($this->bidding->bid_amount, 2).' bid on auction ['.$this->bidding->auction->auction_code.'].')
            ->action('View Details', url('/bidding/'.encrypt($this->bidding->auction_id)))
            ->line('Thank you! Good luck with your bid!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
