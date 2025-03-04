@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    
    <div class="row">
        @foreach($auctions as $auction)
            <div class="col-lg-4 text-center">
                <livewire:auctions.tab :auction="$auction"/>
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
    <script>
        
    </script>
@endpush