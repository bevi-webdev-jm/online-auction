<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bidding;

class BiddingController extends Controller
{
    public function index($id) {
        $auction = Auction::findOrFail(decrypt($id));

        $item = $auction->item;

        return view('pages.biddings.index')->with([
            'auction' => $auction,
            'item' => $item
        ]);
    }

    public function list($id) {
        $auction = Auction::findOrFail(decrypt($id));

        $bidders = Bidding::orderBy('bid_amount', 'DESC')
            ->where('auction_id', $auction->id)
            ->paginate(10)->appends(request()->query());

        return view('pages.biddings.list')->with([
            'auction' => $auction,
            'bidders' => $bidders
        ]);
    }

    public function my_bids() {
        $biddings = Bidding::orderBy('created_at', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);

        return view('pages.biddings.mybid')->with([
            'biddings' => $biddings
        ]);
    }
}
