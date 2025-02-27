@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'COMPANY LIST')
@section('content_header_title', 'COMPANIES')
@section('content_header_subtitle', 'COMPANY LIST')

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">COMPANY LIST</strong>
                </div>
                <div class="col-lg-6 text-right">
                    @can('company create')
                        <a href="{{route('company.create')}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-file"></i>
                            NEW COMPANY
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$company->name}}
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{route('company.show', encrypt($company->id, 'roles'))}}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            VIEW
                                        </a>
                                        @can('company edit')
                                            <a href="{{route('company.edit', encrypt($company->id, 'roles'))}}" class="btn btn-success btn-xs mb-0 ml-0">
                                                <i class="fa fa-pen-alt"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                        @can('company delete')
                                            <a href="" class="btn btn-danger btn-xs mb-0 ml-0 btn-delete" data-id="{{encrypt($company->id)}}">
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
            {{$companies->links()}}
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
        $(function() {
            $('body').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Livewire.dispatch('setDeleteModel', {type: 'Company', model_id: id});
                $('#modal-delete').modal('show');
            });
        });
    </script>
@endpush