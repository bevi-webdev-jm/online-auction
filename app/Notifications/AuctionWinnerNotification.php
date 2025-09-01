<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AuctionWinnerNotification extends Notification
{
    use Queueable;

    protected $auction;

    /**
     * Create a new notification instance.
     */
    public function __construct($auction)
    {
        $this->auction = $auction;
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
        // Generate the PDF
        $pdf = PDF::loadView('pages.auctions.pdf', [
            'auction' => $this->auction,
        ]);

        $filename = 'auction-' . $this->auction->auction_code . '-' . time() . '.pdf';

        return (new MailMessage)
            ->from('notify@bevi.ph', 'ONLINE AUCTION')
            ->subject('🎉 Congratulations! You Won the Auction')
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line('We’re excited to inform you that you’ve successfully won the auction with the code: **' . $this->auction->auction_code . '**.')
            ->line('Attached is a summary of your winning bid. You can also view more details by clicking the button below.')
            ->action('View Auction Details', url('/bidding/' . encrypt($this->auction->id)))
            ->line('Thank you for participating in the auction, and congratulations again on your successful bid!')
            ->attachData($pdf->output(), $filename, [
                'mime' => 'application/pdf',
            ]);
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
