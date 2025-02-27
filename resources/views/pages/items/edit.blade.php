@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'EDIT ITEM')
@section('content_header_title', 'ITEMS')
@section('content_header_subtitle', 'EDIT ITEM')

{{-- Content body: main page content --}}
@section('content_body')
    <livewire:items.form type="update" :item="$item"/>
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
            
        })
    </script>
@endpush