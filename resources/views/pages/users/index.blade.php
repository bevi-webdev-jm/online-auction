@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'USER LIST')
@section('content_header_title', 'USERS')
@section('content_header_subtitle', 'USER LIST')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">USER LIST</strong>
                </div>
                <div class="col-lg-6 text-right">
                    @can('user create')
                        <a href="{{route('user.create')}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-file"></i>
                            NEW USER
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-12 table-responsive p-1 bg-gray rounded">
                    <table class="table table-sm table-striped table-hover bg-white mb-0">
                        <thead class="tex-center bg-dark">
                            <tr class="text-center">
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>COMPANY</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$user->name}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$user->email}}
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{route('user.show', encrypt($user->id, 'users'))}}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            VIEW
                                        </a>
                                        @can('user edit')
                                            <a href="{{route('user.edit', encrypt($user->id, 'users'))}}" class="btn btn-success btn-xs mb-0 ml-0">
                                                <i class="fa fa-pen-alt"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                        @can('user delete')
                                            <a href="" class="btn btn-danger btn-xs mb-0 ml-0">
                                                <i class="fa fa-trash-alt"></i>
                                                DELETE
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{$users->links()}}
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