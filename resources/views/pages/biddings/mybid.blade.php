@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'BIDDING')
@section('content_header_title', 'BIDDING')
@section('content_header_subtitle', 'BIDDING DETAILS')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">MY BIDS</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-striped table-hover bg-white mb-0">
                        <thead class="tex-center bg-dark">
                            <tr class="text-center">
                                <th>AUCTION</th>
                                <th>ITEM</th>
                                <th>BID AMOUNT</th>
                                <th>BID TIMESTAMP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($biddings as $bidding)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$bidding->auction->auction_code}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$bidding->auction->item->item_number ?? ''}}
                                        {{$bidding->auction->item->name ?? ''}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{number_format($bidding->bid_amount, 2)}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{date('Y-m-d H:i:s a', strtotime($bidding->created_at))}}
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{route('bidding.index', encrypt($bidding->id))}}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            VIEW
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{$biddings->links()}}
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