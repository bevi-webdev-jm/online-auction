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
        <a href="auction.html" class="btn btn-primary">Explore Auctions</a>
    </header>

    <section class="container text-center my-5">
        <h2>FEATURED AUCTIONS</h2>
        
        <div class="row">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-lg-3">
                    <div class="position-relative">
                        <img src="{{asset('/vendor/adminlte/dist/img/photo'.$i.'.'.($i >= 3 ? 'jpg' : 'png'))}}" alt="Photo 2" class="img-fluid">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-lg">
                                OPEN
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush