<div>
    <a href="{{asset($item->pictures()->first()->path).'/large.jpg'}}" data-toggle="lightbox" data-title="{{$item->pictures()->first()->title}}">
        <div class="card mb-2 bg-gradient-dark text-left rounded">
            <img class="card-img-top rounded img-preview" src="{{asset($item->pictures()->first()->path).'/large.jpg'}}" alt="{{$item->pictures()->first()->title}}">

            <div class="ribbon-wrapper ribbon-xl">
                <div class="ribbon bg-{{$status_arr[$status]}} text-lg">
                    {{$status}}
                </div>
            </div>

            <div class="card-img-overlay d-flex flex-column justify-content-end p-2">
                <div class="bg-gray-transparent p-2 rounded">
                    <h5 class="card-title text-primary text-white">{{$auction->auction_code}}</h5>
                    <p class="card-text text-white pb-2 pt-1">{{$item->name}}</p>
                    <a href="#" class="text-white">START: {{date('Y-m-d H:i:s a', strtotime($auction->start.' '.$auction->start_time))}}</a>
                    <br>
                    <a href="#" class="text-white">END: {{date('Y-m-d H:i:s a', strtotime($auction->end.' '.$auction->end_time))}}</a>
                </div>
            </div>
        </div>
    </a>

    @if($status != 'ENDED')
        <!-- time counter -->
        <div wire:poll.1000ms>
            <h6 class="bg-{{$status_arr[$status]}} mb-1 rounded">
                <b>{{$status == 'OPEN' ? 'ENDS IN: ' : 'STARTS IN: '}}</b>
                {{$this->getTimeRemaining()}}
            </h6>
        </div>
     @endif

    @can('bidding access')
        @if($status == 'OPEN')
            <a href="{{route('bidding.index', encrypt($auction->id))}}" class="btn btn-danger btn-sm">
                <i class="fa fa-gavel mr-1"></i>
                BID
            </a>
        @endif
    @endcan
</div>
