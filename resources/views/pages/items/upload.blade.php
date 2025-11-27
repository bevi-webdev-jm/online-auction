@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'ITEM UPLOAD')
@section('content_header_title', 'ITEMS')
@section('content_header_subtitle', 'ITEM UPLOAD')

{{-- Content body: main page content --}}
@section('content_body')
    <livewire:items.upload />
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
