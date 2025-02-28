<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

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
}
