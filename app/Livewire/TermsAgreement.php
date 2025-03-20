<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Auction;

class TermsAgreement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function Accept() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 1
        ]);
    }

    public function Decline() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 2
        ]);
    }

    public function ReadAgain() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 0
        ]);
    }

    public function render()
    {
        $auctions =  Auction::where('end', '>=', date('Y-m-d', strtotime('-2 days'))) // Auctions that ended in the last 2 days
            ->orderBy('start', 'ASC')
            ->orderBy('start_time', 'ASC')
            ->when(!empty($this->search), function($query) {
                $query->where('auction_code', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('status', 'LIKE', '%'.$this->search.'%')
                    ->orWhereHas('item', function($qry) {
                        $qry->where('item_number', 'like', '%'.$this->search.'%')
                            ->orWhere('name', 'like', '%'.$this->search.'%');
                    });
            })
            ->get();


        return view('livewire.terms-agreement')->with([
            'auctions' => $auctions
        ]);
    }
}
