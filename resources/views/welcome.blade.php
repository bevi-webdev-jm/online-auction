@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    @auth
        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-success btn-sm">
            <i class="fa fa-sign-in-alt fa-sm"></i>
            Log in
        </a>
    @endauth

    <header class="text-center bg-black text-white py-5 mt-2 rounded">
        <h1>WELCOME TO ONLINE AUCTION</h1>
        <p>Bid on unique items and win amazing deals!</p>
    </header>

    <section class="container text-center my-5">
        <h2 class="text-white font-weight-bold">FEATURED AUCTIONS</h2>
        
        <div class="row">
            @foreach($auctions as $auction)
                <a href="{{asset($auction->item->pictures()->first()->path).'/large.jpg'}}" data-toggle="lightbox" data-title="Image preview">
                    <div class="col-lg-4 text-center">
                        <div class="card mb-2 bg-gradient-dark text-left rounded">
                            <img class="card-img-top rounded img-preview" src="{{asset($auction->item->pictures()->first()->path).'/large.jpg'}}" alt="{{$auction->item->pictures()->first()->title}}">

                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-{{$status_arr[$auction->status]}} text-lg">
                                    {{$auction->status}}
                                </div>
                            </div>

                            <div class="card-img-overlay d-flex flex-column justify-content-end p-2">
                                <div class="bg-gray-transparent p-2 rounded">
                                    <h5 class="card-title text-primary text-white">{{$auction->auction_code}}</h5>
                                    <p class="card-text text-white pb-2 pt-1">{{$auction->item->name}}</p>
                                    <a href="#" class="text-white">START: {{date('Y-m-d H:i:s a', strtotime($auction->start.' '.$auction->start_time))}}</a>
                                    <br>
                                    <a href="#" class="text-white">END: {{date('Y-m-d H:i:s a', strtotime($auction->end.' '.$auction->end_time))}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

@stop

{{-- Push extra CSS --}}

@push('css')
<style>
    .content-wrapper {
        background-image:url('/assets/images/openart-image_4.svg') !important;
        /* background: rgb(161, 161, 161) !important; */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
    }

    .bg-gray-transparent {
        background-color: rgba(0, 0, 0, 0.7);
    }
    .img-preview {
        max-height: 270px !important;
    }
</style>
@endpush

{{-- Push extra scripts --}}
@section('plugins.EkkoLightbox', true)
@push('js')
@endpush