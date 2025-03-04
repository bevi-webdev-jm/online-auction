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

    @if((!empty($auction->bid_limit) && $user_biddings->count() < $auction->bid_limit) || empty($auction->bid_limit))
        <hr>
        <h4>PLACE YOU BID</h4>
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
