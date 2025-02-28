@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'ITEM DETAILS')
@section('content_header_title', 'ITEMS')
@section('content_header_subtitle', 'ITEM DETAILS')

{{-- Content body: main page content --}}
@section('content_body')
<div class="row">
    <!-- DETAILS -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">ITEM DETAILS</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('item.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body py-1">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item py-1 border-top-0">
                        <b>ITEM NUMBER:</b>
                        <span class="float-right">{{$item->item_number ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>NAME:</b>
                        <span class="float-right">{{$item->name ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>BRAND:</b>
                        <span class="float-right">{{$item->brand ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>CREATED AT:</b>
                        <span class="float-right">{{$item->created_at ?? '-'}}</span>
                    </li>
                    <li class="list-group-item py-1 border-bottom-0">
                        <b>UPDATED AT:</b>
                        <span class="float-right">{{$item->updated_at ?? '-'}}</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <!-- SPECIFICATIONS -->
     <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ITEM SPECIFICATIONS</h3>
            </div>
            <div class="card-body py-0">
                <ul class="list-group list-group-unbordered">
                    @foreach($item->specifications as $specification)
                        <li class="list-group-item py-1 border-top-0">
                            <b>{{strtoupper($specification->specification)}}:</b>
                            <span class="float-right">{{$specification->value ?? '-'}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
     </div>

     <!-- PICTURES -->
      <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ITEM PICTURES</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($item->pictures as $picture)
                            <div class="col-lg-3">
                                <img src="{{asset($picture->path).'/large.jpg'}}" alt="{{$picture->title}}" class="item-img">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
      </div>
</div>
    
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .item-img {
            width: 100%;
            max-height: 250px;
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(function() {
        });
    </script>
@endpush