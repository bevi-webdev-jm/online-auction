@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'ROLE EDIT')
@section('content_header_title', 'ROLES')
@section('content_header_subtitle', 'ROLES EDIT')

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('role.update', encrypt($role->id)))->open() }}
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
            
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            {{ html()->label('ROLE NAME', 'name')->class(['mb-0']) }}
                            {{ html()->input('text', 'name', $role->name)->placeholder('Role name')->required(true)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('name')]) }}
                            <small>{{$errors->first('name')}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        {{ html()->label('PERMISSIONS')->class(['text-danger' => $errors->has('permissions')]) }}
                    </div>
                    @foreach($permissions as $group => $permission_arr)
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$group}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($permission_arr as $id => $permission)
                                            <div class="col-12">
                                                <div class="custom-control custom-switch">
                                                    {{ html()->checkbox('permissions[]', $role->hasPermissionTo($permission['name']), $permission['name'])->class(['custom-control-input'])->id('permission'.$id) }}
                                                    {{ html()->label(ucwords($permission['name']), 'permission'.$id)->class(['custom-control-label']) }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> SAVE ROLE')->class(['btn', 'btn-primary', 'btn-sm']) }}
            </div>
        </div>
    {{ html()->form()->close() }}
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