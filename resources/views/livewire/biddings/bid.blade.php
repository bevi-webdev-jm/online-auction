<div>
    @if((auth()->user()->can('bidding leader') || $auction->show_leading_bidder) && !empty($highest_bidder))
        <hr>
        <h4>HIGEST BIDDER</h4>
        <div class="bg-success px-3 py-1 rounded">
            <h3 class="font-weight-bold mb-0">
                {{$highest_bidder->user->name}}
            </h3>
        </div>
    @endif

    @if($auction->show_last_place_bidder && !empty($lowest_bidder))
        <hr>
        <h4>LOWEST BIDDER</h4>
        <div class="bg-warning px-3 py-1 rounded">
            <h3 class="font-weight-bold mb-0">
                {{$lowest_bidder->user->name}}
            </h3>
        </div>
    @endif

    @if(!empty($user_biddings->count()))
        <hr>
        <h4>YOUR BID</h4>
        <div class="bg-info py-2 px-3 mt-1 rounded">
            <h2 class="mb-0 font-weight-bold">
                {{number_format($user_biddings->first()->bid_amount, 2)}}
            </h2>
            <span class="mt-0">
                <small>Please wait for the auction to end to see the result. Good luck!</small>
            </span>
        </div>
    @endif

    @if(
            ((!empty($auction->bid_limit) && $user_biddings->count() < $auction->bid_limit) || empty($auction->bid_limit)) 
            && $auction->status == 'OPEN'
            && (!empty($auction->restrict_to_company_only) && $auction->company_id == auth()->user()->company_id || empty($auction->restrict_to_company_only))
        )

        <hr>
        <h4 class="mb-0">PLACE YOU BID</h4>

        <div class="">
            <a href="#" class="text-primary" wire:click.prevent="readMechanics">
                <i class="fa fa-info-circle fa-sm"></i>
                Read auction mechanics
            </a>
        </div>

        @if($read_mechanics)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">READ TERMS AND CONDITIONS</h3>
                </div>
                <div class="card-body">

                    <h5>ONLINE BIDDING MECHANICS</h5>

                    <strong>Bidding Process</strong>
                    <ul>
                        <li>Each auction item will have a minimum bid amount, and users must bid greater than or equal to this amount.</li>
                        <li>Participants can place only bid once per item.</li>
                        <li>All items for auction will be available for a period of time (e.g. 7 days).</li>
                        <li>Items without bidder will be re-auctioned at a later date.</li>
                    </ul>

                    <strong>Bidding Rules</strong>
                    <ul>
                        <li>Once a bid is placed, it cannot be canceled or withdrawn.</li>
                        <li>Bidders must meet or exceed the minimum bid requirement.</li>
                        <li>The highest bid at the closing time wins the auction.</li>
                        <li>If multiple users place the same highest bid, the first bidder will be declared the winner.</li>
                    </ul>

                    <strong>Payment and Confirmation</strong>
                    <ul>
                        <li>Payment shall only be paid in cash.</li>
                        <li>Payments must be completed within two (2) days.</li>
                        <li>Failure to pay within the timeframe may result in the item being awarded to the next highest bidder.</li>
                    </ul>
                    
                    <strong>Item Pickup</strong>
                    <ul>
                        <li>Upon successful payment, the item will be available for pickup at IT Department.</li>
                        <li>You can check and test the item at IT department to validate that the details are correctly specified in the auction.</li>
                    </ul>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-secondary btn-sm" wire:click.prevent="readMechanics">
                        CLOSE
                    </button>
                </div>
            </div>
        @endif
        
        <div class="bg-gray pt-2 px-3 mt-1 rounded">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="mb-0">BID AMOUNT</label>
                        <input type="number" class="form-control form-control-sm{{$errors->has('bid_amount') ? ' is-invalid' : ''}}" wire:model="bid_amount">
                        <small class="text-light">{{$errors->first('bid_amount')}}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-1">
            <a href="#" class="btn btn-primary btn-lg btn-flat" wire:click.prevent="PlaceBid">
                <i class="fas fa-thumbs-up fa-lg mr-2"></i>
                PLACE MY BID
            </a>
        </div>
    @endif
    
</div>
