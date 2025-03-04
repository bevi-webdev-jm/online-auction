<?php

namespace App\Livewire\Biddings;

use Livewire\Component;
use App\Models\Bidding;

class Bid extends Component
{
    public $auction;
    public $bid_amount;
    public $user_biddings;
    public $highest_bidder = null;

    public function PlaceBid() {
        $this->validate([
            'bid_amount' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        if ($value < $this->auction->min_bid) {
                            $fail('bid amount should be greater than '.number_format($this->auction->min_bid, 2));
                        }
                    } catch (\Exception $e) {
                        $fail('Invalid bid amount.');
                    }
                }
            ]
        ]);

        $bidding = new Bidding([
            'auction_id' => $this->auction->id,
            'user_id' => auth()->user()->id,
            'bid_amount' => $this->bid_amount
        ]);
        $bidding->save();

        // log
        activity('bid')
            ->performedOn($bidding)
            ->log(':causer.name placed a '.number_format($this->bid_amount, 2).' bid on '.$this->auction->auction_code);
    }

    public function checkDuplicateBid() {
        $this->user_biddings = Bidding::where('auction_id', $this->auction->id)
            ->where('user_id', auth()->user()->id)
            ->get();
    }

    public function mount($auction) {
        $this->auction = $auction;
    }

    public function render()
    {
        if(auth()->user()->can('bidding leader')) {
            $this->highest_bidder = Bidding::where('auction_id', $this->auction->id)
                ->orderBy('bid_amount', 'DESC')
                ->first();
        }

        $this->checkDuplicateBid();

        return view('livewire.biddings.bid');
    }
}
