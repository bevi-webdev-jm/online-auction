@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    
    <div class="row">
        @foreach($auctions as $auction)
            @php
                $item = $auction->item;
            @endphp

            <div class="col-lg-4 text-center">
                <a href="{{asset($item->pictures()->first()->path).'/large.jpg'}}" data-toggle="lightbox" data-title="{{$item->pictures()->first()->title}}">
                    <div class="card mb-2 bg-gradient-dark text-left rounded">
                        <img class="card-img-top rounded" src="{{asset($item->pictures()->first()->path).'/large.jpg'}}" alt="{{$item->pictures()->first()->title}}">

                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-lg">
                                OPEN
                            </div>
                        </div>

                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <div class="bg-gray-transparent p-2 rounded">
                                <h5 class="card-title text-primary text-white">{{$auction->auction_code}}</h5>
                                <p class="card-text text-white pb-2 pt-1">{{$item->name}}</p>
                                <a href="#" class="text-white">START: {{$auction->start}} {{$auction->start_time}}</a>
                                <br>
                                <a href="#" class="text-white">END: {{$auction->end}} {{$auction->end_time}}</a>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="" class="btn btn-danger btn-sm">
                    <i class="fa fa-gavel mr-1"></i>
                    BID
                </a>
            </div>
        @endforeach
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .bg-gray-transparent {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@section('plugins.EkkoLightbox', true)
@push('js')
    <script>
        
    </script>
@endpush