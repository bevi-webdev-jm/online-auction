@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'SYSTEM LOGS')
@section('content_header_title', 'SYSTEM LOGS')
@section('content_header_subtitle', 'SYSTEM LOGS LIST')

{{-- Content body: main page content --}}
@section('content_body')
    {{ html()->form('GET', route('system-logs'))->open() }}

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SYSTEM LOGS</h3>
            </div>
            <div class="card-body">

                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label('SEARCH', 'search')->class('mb-0') }}
                            {{ html()->input('text', 'search', $search)->placeholder('Search')->class(['form-control', 'form-control-sm'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive p-1 bg-gray rounded">
                        <table class="table table-sm table-striped table-hover bg-white mb-0">
                            <thead class="text-center bg-dark">
                                <tr>
                                    <th>LOG NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>USER</th>
                                    <th>CHANGES</th>
                                    <th>TIMESTAMP</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{$activity->log_name}}</td>
                                        <td>{{$activity->description}}</td>
                                        <td>
                                            {{$activity->causer->name}}
                                        </td>
                                        <td class="p-1 text-xs">
                                            @if($activity->log_name == 'updated' && !empty($updates[$activity->id]))
                                                <ul class="list-group">
                                                    @foreach($updates[$activity->id] as $column => $data)
                                                        <li class="list-group-item p-0">
                                                            <b>{{$column}}:</b> {{$data['old']}}
                                                            <p class="m-0 p-0 d-inline">
                                                                <b>to:</b> {{$data['new']}}
                                                            </p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>{{date('F j, Y H:i:s a', strtotime($activity->created_at))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                {{$activities->links()}}
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