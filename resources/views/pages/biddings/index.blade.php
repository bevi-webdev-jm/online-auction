@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'BIDDING')
@section('content_header_title', 'BIDDING')
@section('content_header_subtitle', 'BIDDING DETAILS')

{{-- Content body: main page content --}}
@section('content_body')

<div class="row mb-2">
    <div class="col-12">
        <a href="{{route('home')}}" class="btn btn-primary btn-sm">
            <i class="fa fa-home"></i>
            BACK TO HOME
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$item->name}}</h3>
                <div class="col-12">
                    @php
                        $first_picture = $item->pictures()->first();
                    @endphp
                    <img src="{{asset($first_picture->path).'/large.jpg'}}" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                    @foreach($item->pictures as $picture)
                        <div class="product-image-thumb{{$first_picture->id == $picture->id ? ' active' : ''}}">
                            <img src="{{asset($picture->path).'/large.jpg'}}" alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="mt-3">AUCTION CODE: <span class="badge badge-primary text-lg pt-1">{{$auction->auction_code}}</span></h3>
                <ul class="list-group">
                    <li class="list-group-item py-1">
                        <b>
                            START:
                        </b>
                        <span class="float-right">
                            {{$auction->start}} {{$auction->start_time}}
                        </span>
                    </li>
                    <li class="list-group-item py-1">
                        <b>
                            END:
                        </b>
                        <span class="float-right">
                            {{$auction->end}} {{$auction->end_time}}
                        </span>
                    </li>
                </ul>

                <hr>
                <h4>ITEM DETAILS</h4>
                <h3 class="mt-3">[{{$item->item_number}}] {{$item->name}}</h3>
                <p>{{$item->brand}}</p>

                <hr>
                <h4>SPECIFICATIONS</h4>
                <ul class="list-group">
                    @foreach($item->specifications as $specification)
                        <li class="list-group-item py-1">
                            <b>
                                {{$specification->specification}}:
                            </b>
                            <span class="float-right">
                                {{$specification->value}}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <livewire:biddings.bid :auction="$auction"/>
            </div>
        </div>
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