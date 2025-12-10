<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">USER BIDS</h3>
        </div>
        <div class="card-body">

            <div class="row mb-1">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Search</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Search" wire:model.live="search">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-striped table-hover bg-white mb-0">
                        <thead class="text-center bg-dark">
                            <tr>
                                <th>AUCTION NUMBER</th>
                                <th>AMOUNT</th>
                                <th>TIMESTAMP</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($biddings as $bidding)
                                <tr>
                                    <td>
                                        <a href="{{ route('auction.show', encrypt($bidding->auction_id)) }}">
                                            {{$bidding->auction->auction_code}}
                                        </a>
                                    </td>
                                    <td>{{number_format($bidding->bid_amount, 2)}}</td>
                                    <td>{{date('F j, Y H:i:s a', strtotime($bidding->created_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{ $biddings->links() }}
        </div>
    </div>
</div>
