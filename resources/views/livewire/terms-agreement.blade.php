<div>
    @if(auth()->user()->accepts_terms_and_conditions == 1)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">AUCTIONS</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($auctions as $auction)
                        @if(($auction->restrict_to_company_only && $auction->company_id == auth()->user()->company_id) || empty($auction->restrict_to_company_only) || auth()->user()->hasRole('superadmin'))
                            <div class="col-lg-4 text-center">
                                <livewire:auctions.tab :auction="$auction"/>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        
    @elseif(auth()->user()->accepts_terms_and_conditions == 2)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">READ TERMS AND CONDITIONS</h3>
            </div>
            <div class="card-body">

                <h5>ONLINE BIDDING GUIDELINES</h5>

                <strong>You declined the terms and conditions</strong>
                <ul>
                    <li>To access the auction items and participate in bidding, you must read and accept the terms and conditions.</li>
                    <li>Please review the terms carefully before proceeding.</li>
                </ul>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" wire:click.prevent="ReadAgain">
                    READ TERMS
                </button>
            </div>
        </div>
    @else
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
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" wire:click.prevent="Accept">
                    ACCEPT
                </button>
                <button class="btn btn-danger btn-sm" wire:click.prevent="Decline">
                    DECLINE
                </button>
            </div>
        </div>
    @endif
</div>
