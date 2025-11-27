@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'ITEM LIST')
@section('content_header_title', 'ITEMS')
@section('content_header_subtitle', 'ITEM LIST')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">ITEM LIST</strong>
                </div>
                <div class="col-lg-6 text-right">
                    @can('item create')
                        <a href="{{route('item.create')}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-file"></i>
                            NEW ITEM
                        </a>
                    @endcan
                    @can('item upload')
                        <a href="{{route('item.upload')}}" class="btn btn-info btn-xs">
                            <i class="fa fa-upload"></i>
                            UPLOAD ITEM
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">

            {{ html()->form('GET', route('item.index'))->open() }}
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('Search', 'search')->class(['mb-0']) }}
                            {{ html()->text('search', $search)->class(['form-control', 'form-control-sm'])->placeholder('Search') }}
                        </div>
                    </div>
                </div>
            {{ html()->form()->close() }}

            <div class="row">
                <div class="col-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-striped table-hover bg-white mb-0">
                        <thead class="text-center bg-dark">
                            <tr class="text-center">
                                <th>ITEM NUMBER</th>
                                <th>NAME</th>
                                <th>BRAND</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$item->item_number}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$item->name}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$item->brand}}
                                    </td>
                                    <td class="align-middle text-center">
                                        @php
                                            $auctions = $item->auctions;
                                            $status = 0;
                                            foreach($auctions as $auction) {
                                                if(!empty($auction->auction_winner)) {
                                                    $status = 1;
                                                }
                                            }
                                        @endphp
                                        @if($status)
                                            <span class="badge badge-danger">SOLD</span>
                                        @else
                                            <span class="badge badge-success">AVAILABLE</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{route('item.show', encrypt($item->id, 'roles'))}}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            VIEW
                                        </a>
                                        @can('item edit')
                                            <a href="{{route('item.edit', encrypt($item->id, 'roles'))}}" class="btn btn-success btn-xs mb-0 ml-0">
                                                <i class="fa fa-pen-alt"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                        @can('item delete')
                                            <a href="#" class="btn btn-danger btn-xs mb-0 ml-0 btn-delete" data-id="{{encrypt($item->id)}}">
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
            {{$items->links()}}
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
                Livewire.dispatch('setDeleteModel', {type: 'Item', model_id: id});
                $('#modal-delete').modal('show');
            });
        });
    </script>
@endpush
