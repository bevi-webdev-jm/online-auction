@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'EDIT AUCTION')
@section('content_header_title', 'AUCTIONS')
@section('content_header_subtitle', 'EDIT AUCTION')

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('auction.update', encrypt($auction->id)))->open() }}
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">UPDATE AUCTION</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('auction.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <label>AUCTION CODE:</label>
                        <strong class="badge badge-info pt-1 text-lg">
                            {{$auction->auction_code}}
                        </strong>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('ITEM', 'item_id')->class(['mb-0'])}}
                            {{ html()->select('item_id', $items, $selected_item)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('item_id')])}}
                            <small class="text-danger">{{$errors->first('item_id')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('MIN BID PRICE', 'min_bid')->class(['mb-0']) }}
                            {{ html()->number('min_bid', $auction->min_bid, 0)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('min_bid')])}}
                            <small class="text-danger">{{$errors->first('min_bid')}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('START DATE', 'start')->class(['mb-0'])}}
                            {{ html()->date('start', $auction->start)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('start')])}}
                            <small class="text-danger">{{$errors->first('start')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('START TIME', 'start_time')->class(['mb-0'])}}
                            {{ html()->time('start_time', $auction->start_time)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('start_time')])}}
                            <small class="text-danger">{{$errors->first('start_time')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('END DATE', 'end')->class(['mb-0'])}}
                            {{ html()->date('end', $auction->end)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('end')])}}
                            <small class="text-danger">{{$errors->first('end')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('END TIME', 'end_time')->class(['mb-0'])}}
                            {{ html()->time('end_time', $auction->end_time)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('end_time')])}}
                            <small class="text-danger">{{$errors->first('end_time')}}</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> SAVE AUCTION')->class(['btn', 'btn-primary', 'btn-sm']) }}
            </div>
        </div>
    {{ html()->form()->close() }}
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