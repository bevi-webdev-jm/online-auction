@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'USER DETAILS')
@section('content_header_title', 'USERS')
@section('content_header_subtitle', 'USER DETAILS')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row">
        <!-- USER DETAILS -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 align-middle">
                            <strong class="text-lg">USER DETAILS</strong>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="{{route('user.index')}}" class="btn btn-secondary btn-xs">
                                <i class="fa fa-caret-left"></i>
                                BACK
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-1">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item py-1 border-top-0">
                            <b>NAME:</b>
                            <span class="float-right">{{$user->name ?? '-'}}</span>
                        </li>
                        <li class="list-group-item py-1">
                            <b>EMAIL:</b>
                            <span class="float-right">{{$user->email ?? '-'}}</span>
                        </li>
                        <li class="list-group-item py-1">
                            <b>ROLES:</b>
                            <span class="float-right">{{implode(', ', $user->roles->pluck('name')->toArray()) ?? '-'}}</span>
                        </li>
                        <li class="list-group-item py-1">
                            <b>CREATED AT:</b>
                            <span class="float-right">{{$user->created_at ?? '-'}}</span>
                        </li>
                        <li class="list-group-item py-1 border-bottom-0">
                            <b>UPDATED AT:</b>
                            <span class="float-right">{{$user->updated_at ?? '-'}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-lg-8">

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