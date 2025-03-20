@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')

    <livewire:terms-agreement/>

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