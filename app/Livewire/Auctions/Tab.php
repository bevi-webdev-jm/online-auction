<?php

namespace App\Livewire\Auctions;

use Livewire\Component;
use App\Models\Bidding;
use App\Models\AuctionWinner;

class Tab extends Component
{
    public $auction;
    public $item;
    public $status;
    public $status_arr = [
        'OPEN' => 'success',
        'UPCOMING' => 'warning',
        'ENDED' => 'danger'
    ];

    private function checkStatus() {
        $currentTimestamp = time();
        $startTimestamp = strtotime("{$this->auction->start} {$this->auction->start_time}");
        $endTimestamp = strtotime("{$this->auction->end} {$this->auction->end_time}");
    
        if ($currentTimestamp < $startTimestamp) {
            $this->status = 'UPCOMING';
        } elseif ($currentTimestamp > $endTimestamp) {
            $this->status = 'ENDED';
        } else {
            $this->status = 'OPEN';
        }

        $this->auction->update([
            'status' => $this->status
        ]);

        $this->getAuctionWinner();
    }

    private function getAuctionWinner() {
        if($this->status == 'ENDED') {
            // get highest bid and the first to bid
            $highest_bid = Bidding::where('auction_id', $this->auction->id)
                ->orderBy('bid_amount', 'DESC')
                ->orderBy('created_at', 'ASC')
                ->first();

            // check if exists
            $auction_winner = AuctionWinner::where('auction_id', $this->auction->id)
                ->first();

            if(!empty($auction_winner)) {
                $auction_winner->update([
                    'auction_id' => $this->auction->id,
                    'bidding_id' => $highest_bid->id
                ]);
            } else {
                if(!empty($highest_bid)) {
                    $auction_winner = new AuctionWinner([
                        'auction_id' => $this->auction->id,
                        'bidding_id' => $highest_bid->id
                    ]);
                    $auction_winner->save();
                }
            }
        }
    }

    public function getTimeRemaining() {
        $currentTimestamp = time();
        $startTimestamp = strtotime("{$this->auction->start} {$this->auction->start_time}");
        $endTimestamp = strtotime("{$this->auction->end} {$this->auction->end_time}");
    
        if ($this->status === 'OPEN') {
            return $this->formatTime($endTimestamp - $currentTimestamp);
        } elseif ($this->status === 'UPCOMING') {
            return $this->formatTime($startTimestamp - $currentTimestamp);
        }
    
        return null; // No time remaining if status is 'ENDED'
    }
    
    private function formatTime($seconds) {
        if ($seconds <= 0) {
            return '0 seconds';
        }
    
        $days = floor($seconds / 86400);
        $hours = floor(($seconds % 86400) / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
    
        $parts = [];
        if ($days > 0) $parts[] = "$days day" . ($days > 1 ? 's' : '');
        if ($hours > 0) $parts[] = "$hours hr" . ($hours > 1 ? 's' : '');
        if ($minutes > 0) $parts[] = "$minutes min" . ($minutes > 1 ? 's' : '');
        if ($seconds > 0) $parts[] = "$seconds sec" . ($seconds > 1 ? 's' : '');
    
        return implode(', ', $parts);
    }

    public function mount($auction) {
        $this->auction = $auction;

        $this->item = $auction->item;
    }

    public function render()
    {
        $this->checkStatus();

        return view('livewire.auctions.tab');
    }
}
