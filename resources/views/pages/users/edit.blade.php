@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'USER ADD')
@section('content_header_title', 'USERS')
@section('content_header_subtitle', 'USER ADD')

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('user.update', encrypt($user->id)))->open() }}
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">USER ADD</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('user.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('NAME', 'name')->class(['mb-0']) }}
                            {{ html()->input('text', 'name', $user->name)->placeholder('Name')->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('name')]); }}
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('EMAIL', 'email')->class(['mb-0']) }}
                            {{ html()->input('email', 'email', $user->email)->placeholder('Email')->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('email')]); }}
                            <small class="text-danger">{{$errors->first('email')}}</small>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ html()->label('COMPANY', 'company_id')->class(['mb-0']) }}
                            {{ html()->select('company_id', $companies, $company_selected_id)->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('company_id')]); }}
                            <small class="text-danger">{{$errors->first('company_id')}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        {{ html()->label('ROLES', 'role_ids')->class(['mb-0', 'text-danger' => $errors->has('role_ids')]) }}
                        @if($errors->has('role_ids'))
                            <span class="badge badge-danger pt-1">REQUIRED</span>
                        @endif
                        <hr class="mt-0">
                        {{ html()->hidden('role_ids', implode(',', $user_roles))->id('role_ids')}}
                    </div>

                    <div class="col-12">
                        @foreach($roles as $role)
                            <button class="btn btn-{{in_array($role->name, $user_roles) ? 'success' : 'default'}} btn-role" data-id="{{$role->name}}">{{$role->name}}</button>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> SAVE USER')->class(['btn', 'btn-primary', 'btn-sm']) }}
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
        $(function() {
            $('body').on('click', '.btn-role', function(e) {
                e.preventDefault();
                $(this).toggleClass('btn-success').toggleClass('btn-default');

                // get all selected
                var role_ids = [];
                $('body').find('.btn-role').each(function() {
                    var id = $(this).data('id');
                    if($(this).hasClass('btn-success')) {
                        role_ids.push(id);
                    }
                });

                var roles = role_ids.join(',');
                $('#role_ids').val(roles);
            });
        })
    </script>
@endpush