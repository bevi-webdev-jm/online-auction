@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'QR GENERATOR')
@section('content_header_title', 'QR GENERATOR')
@section('content_header_subtitle', 'QR GENERATOR')

{{-- Content body: main page content --}}

@section('content_body')
    <livewire:qr-generator/>
@stop

{{-- Push extra CSS --}}

@push('css')
<style>
    .content-wrapper {
        /* background-image:url('/assets/images/openart-image_4.svg') !important; */
        background: rgb(161, 161, 161) !important;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 400px; /* Adjust height as needed */
    }
</style>
@endpush

{{-- Push extra scripts --}}
@section('plugins.EkkoLightbox', true)
@push('js')
@endpush