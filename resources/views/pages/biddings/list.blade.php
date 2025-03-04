@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'BIDDERS')
@section('content_header_title', 'BIDDERS')
@section('content_header_subtitle', 'BIDDERS LIST')

{{-- Content body: main page content --}}
@section('content_body')

<div class="row mb-2">
    <div class="col-lg-6">
        <a href="{{route('bidding.index', encrypt($auction->id))}}" class="btn btn-secondary btn-sm">
            <i class="fa fa-home"></i>
            BACK
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 table-responsive p-1 bg-gray rounded">
                <table class="table table-sm table-striped table-hover bg-white mb-0">
                    <thead class="text-center bg-dark">
                        <tr class="text-center">
                            <th>USER</th>
                            <th>BID AMOUNT</th>
                            <th>TIMESTAMP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bidders as $bid)
                            <tr>
                                <td class="align-middle text-center">
                                    {{$bid->user->name}}
                                </td>
                                <td class="align-middle text-center">
                                    {{number_format($bid->bid_amount, 2)}}
                                </td>
                                <td class="align-middle text-center">
                                    {{$bid->created_at}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {{$bidders->links()}}
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
            $('.product-image-thumb').on('click', function () {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            });
        });
    </script>
@endpush