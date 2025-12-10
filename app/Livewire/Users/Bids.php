<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Bidding;

class Bids extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user;
    public $search;

    public function render()
    {
        $biddings = Bidding::orderBy('created_at', 'DESC')
            ->where('user_id', $this->user->id)
            ->when(!empty($this->search), function($query) {
                $query->where(function($qry) {
                    $qry->where('created_at', 'like', '%'.$this->search.'%')
                        ->orWhere('bid_amount', 'like', '%'.$this->search.'%')
                        ->orWhereHas('auction', function($qry1) {
                            $qry1->where('auction_code', 'like', '%'.$this->search.'%');
                        });
                });
            })
            ->paginate(10, ['*'], 'bid-page');

        return view('livewire.users.bids')->with([
            'biddings' => $biddings
        ]);
    }

    public function mount($user) {
        $this->user = $user;
    }

    public function updatedSearch() {
        $this->resetPage('bid-page');
    }
}
