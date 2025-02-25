@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'ROLE LIST')
@section('content_header_title', 'ROLES')
@section('content_header_subtitle', 'ROLES LIST')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">NEW ROLE</strong>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="{{route('role.index')}}" class="btn btn-secondary btn-xs">
                        <i class="fa fa-caret-left"></i>
                        BACK
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
    </script>
@endpush