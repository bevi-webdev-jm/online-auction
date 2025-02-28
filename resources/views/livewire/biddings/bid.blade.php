<div>
    @if(empty($user_biddings->count()))
        <hr>
        <h4>PLACE YOU BID</h4>
        <div class="bg-gray pt-2 px-3 mt-1">
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
    @else
        <hr>
        <h4>YOUR BID</h4>
        <div class="bg-gray py-2 px-3 mt-1">
            <h2 class="mb-0">
                {{number_format($user_biddings->first()->bid_amount)}}
            </h2>
            <span class="mt-0">
                <small>Please wait for the auction to end to see the result. Good luck!</small>
            </span>
        </div>

    @endif
</div>
