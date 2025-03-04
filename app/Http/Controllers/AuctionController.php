<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auction;
use App\Models\Item;
use App\Models\Company;

use App\Http\Requests\AuctionAddRequest;
use App\Http\Requests\AuctionEditRequest;

class AuctionController extends Controller
{
    public function index(Request $request) {
        $auctions = Auction::orderBy('created_at', 'DESC')
            ->paginate(10)->appends(request()->query());

        return view('pages.auctions.index')->with([
            'auctions' => $auctions
        ]);
    }

    public function create() {
        $auction_code = $this->generateAuctionCode();

        $items = Item::orderBy('item_number', 'ASC')
            ->get();

        $items_arr = [];
        foreach($items as $item) {
            $items_arr[encrypt($item->id)] = '['.$item->item_number.'] '.$item->name;
        }

        $companies = Company::orderBy('name', 'ASC')
            ->get();
        $company_arr = [];
        foreach($companies as $company) {
            $company_arr[encrypt($company->id)] = $company->name;
        }

        return view('pages.auctions.create')->with([
            'auction_code' => $auction_code,
            'items' => $items_arr,
            'companies' => $company_arr
        ]);
    }

    public function store(AuctionAddRequest $request) {

        $auction = new Auction([
            'item_id' => decrypt($request->item_id),
            'company_id' => decrypt($request->company_id),
            'auction_code' => $this->generateAuctionCode(),
            'start' => $request->start,
            'start_time' => $request->start_time,
            'end' => $request->end,
            'end_time' => $request->end_time,
            'min_bid' => $request->min_bid,
            'bid_limit' => $request->user_bidding_limit ? $request->bid_limit : NULL,
            'show_bidders' => $request->show_bidders,
            'show_leading_bidder' => $request->show_leading_bidder,
            'show_last_place_bidder' => $request->show_last_place_bidder,
            'restrict_to_company_only' => $request->restrict_to_company_only,
        ]);
        $auction->save();

        // logs
        activity('created')
            ->performedOn($auction)
            ->log(':causer.name has created auction :subject.auction_code');

        return redirect()->route('auction.index')->with([
            'message_success' => 'Auction '.$auction->auction_code.' has been created successfully.'
        ]);

    }

    public function show($id) {
        $auction = Auction::findOrFail(decrypt($id));

        return view('pages.auctions.show')->with([
            'auction' => $auction
        ]);
    }

    public function edit($id) {
        $auction = Auction::findOrFail(decrypt($id));

        $items = Item::orderBy('item_number', 'ASC')
            ->get();

        $items_arr = [];
        $selected_item = '';
        foreach($items as $item) {
            $encrypted_id = encrypt($item->id);
            if($auction->item_id == $item->id) {
                $selected_item = $encrypted_id;
            }
            $items_arr[$encrypted_id] = '['.$item->item_number.'] '.$item->name;
        }

        $companies = Company::orderBy('name', 'ASC')
            ->get();
        $company_arr = [];
        $selected_company = '';
        foreach($companies as $company) {
            $encrypted_id = encrypt($company->id);
            if($auction->company_id == $company->id) {
                $selected_company = $encrypted_id;
            }
            $company_arr[$encrypted_id] = $company->name;
        }

        return view('pages.auctions.edit')->with([
            'auction' => $auction,
            'items' => $items_arr,
            'selected_item' => $selected_item,
            'companies' => $company_arr,
            'selected_company' => $selected_company,
        ]);
    }

    public function update(AuctionEditRequest $request, $id) {
        $auction = Auction::findOrFail(decrypt($id));

        $changes_arr['old'] = $auction->getOriginal();

        $auction->update([
            'item_id' => decrypt($request->item_id),
            'company_id' => decrypt($request->company_id),
            'start' => $request->start,
            'start_time' => $request->start_time,
            'end' => $request->end,
            'end_time' => $request->end_time,
            'min_bid' => $request->min_bid,
            'bid_limit' => $request->user_bidding_limit ? $request->bid_limit : NULL,
            'show_bidders' => $request->show_bidders,
            'show_leading_bidder' => $request->show_leading_bidder,
            'show_last_place_bidder' => $request->show_last_place_bidder,
            'restrict_to_company_only' => $request->restrict_to_company_only,
        ]);

        $changes_arr['changes'] = $auction->getChanges();

        // logs
        activity('updated')
            ->performedOn($auction)
            ->withProperties($changes_arr)
            ->log('causer:name updated auction :subject.auction_code');

        return back()->with([
            'message_success' => 'Auction '.$auction->auction_code.' has been updated successfully.'
        ]);
    }

    private function generateAuctionCode() {
        do {
            // Find the highest existing auction code
            $lastAuction = Auction::where('auction_code', 'LIKE', 'AUCT-%')
                ->orderByDesc('auction_code')
                ->first();
            
            // Extract the last number and increment it
            if ($lastAuction && preg_match('/AUCT-(\d+)/', $lastAuction->auction_code, $matches)) {
                $newNumber = str_pad($matches[1] + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }
    
            // Generate the new auction code
            $code = 'AUCT-' . $newNumber;
        } while (Auction::where('auction_code', $code)->exists()); // Ensure uniqueness
    
        return $code;
    }
}
