@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'AUCTION DETAILS')
@section('content_header_title', 'AUCTIONS')
@section('content_header_subtitle', 'AUCTION DETAILS')

{{-- Content body: main page content --}}
@section('content_body')
<div class="row">
    <!-- DETAILS -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">AUCTION DETAILS</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('auction.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body py-1">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item py-1 border-top-0">
                        <b>AUCTION CODE:</b>
                        <span class="float-right">{{$auction->auction_code ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>ITEM:</b>
                        <span class="float-right">[{{$auction->item->item_number ?? '-'}}] {{$auction->item->name}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>START:</b>
                        <span class="float-right">{{$auction->start ?? '-'}} {{$auction->start_time}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>END:</b>
                        <span class="float-right">{{$auction->end ?? '-'}} {{$auction->end_time}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>MIN BID:</b>
                        <span class="float-right">{{number_format($auction->min_bid, 2) ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>CREATED AT:</b>
                        <span class="float-right">{{$auction->created_at ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1 border-bottom-0">
                        <b>UPDATED AT:</b>
                        <span class="float-right">{{$auction->updated_at ?? '-'}}</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
    
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(function() {
        });
    </script>
@endpush