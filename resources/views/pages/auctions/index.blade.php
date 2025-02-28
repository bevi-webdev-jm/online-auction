@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'AUCTION LIST')
@section('content_header_title', 'AUCTIONS')
@section('content_header_subtitle', 'AUCTION LIST')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">AUCTION LIST</strong>
                </div>
                <div class="col-lg-6 text-right">
                    @can('auction create')
                        <a href="{{route('auction.create')}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-file"></i>
                            NEW AUCTION
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-striped table-hover bg-white mb-0">
                        <thead class="text-center bg-dark">
                            <tr class="text-center">
                                <th>AUCTION CODE</th>
                                <th>ITEM</th>
                                <th>START</th>
                                <th>END</th>
                                <th>MIN BID</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auctions as $auction)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$auction->auction_code}}
                                    </td>
                                    <td class="align-middle text-center">
                                        [{{$auction->item->item_number}}] {{$auction->item->name}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$auction->start}} {{$auction->start_time}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$auction->end}} {{$auction->end_time}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{number_format($auction->min_bid, 2)}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$auction->status ?? '-'}}
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{route('auction.show', encrypt($auction->id, 'auctions'))}}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            VIEW
                                        </a>
                                        @can('auction edit')
                                            <a href="{{route('auction.edit', encrypt($auction->id, 'auctions'))}}" class="btn btn-success btn-xs mb-0 ml-0">
                                                <i class="fa fa-pen-alt"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                        @can('auction delete')
                                            <a href="#" class="btn btn-danger btn-xs mb-0 ml-0 btn-delete" data-id="{{encrypt($auction->id)}}">
                                                <i class="fa fa-trash-alt"></i>
                                                DELETE
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{$auctions->links()}}
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
            $('body').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Livewire.dispatch('setDeleteModel', {type: 'Auction', model_id: id});
                $('#modal-delete').modal('show');
            });
        });
    </script>
@endpush