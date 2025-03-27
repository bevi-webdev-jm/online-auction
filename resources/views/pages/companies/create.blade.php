@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'NEW COMPANY')
@section('content_header_title', 'COMPANIES')
@section('content_header_subtitle', 'NEW COMPANY')

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('POST', route('company.store'))->open() }}

        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-lg-6 align-middle">
                        <strong class="text-lg">NEW COMPANY</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('company.index')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label('NAME', 'name')->class(['mb-0']) }}
                            {{ 
                                html()->text('name', '')
                                ->class(['form-control', 'form-control-sm', 'is-invalid' => $errors->has('name')])
                                ->placeholder('Company name')
                            }}
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer text-right">
                {{ html()->submit('<i class="fa fa-save"></i> SAVE COMPANY')->class(['btn', 'btn-primary', 'btn-sm']) }}
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
        });
    </script>
@endpush