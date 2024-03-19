@extends('layouts.master')

@section('title')
    Slider
@endsection


@section('content') {{-- Thay thế nội dung của class với cú pháp @yueld --}}

<div class="">
    <div class="">

        <div id="carouselBanners" class="carousel slide my-5" data-ride="carousel" data-interval="6000">
            <ol class="carousel-indicators">
                @foreach($banners as $key =>  $item)
                    <li data-target="#carouselBanners" data-slide-to="{{$key}}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($banners as $key =>  $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div style="
                            background-position: center;
                            /*background: #FC5C7D;  !* fallback for old browsers *!*/
                            background: -webkit-linear-gradient({{ $item->background }});  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient({{ $item->background }}); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                        ">
                            <div class="container">

                                <div class="d-lg-flex justify-content-between d-block flex-lg-column-reverse position-relative banner-item">
                                    <div class="img-right position-absolute my-auto">
                                        <img src = "{{ $item->image }}" />
                                    </div>
                                    <div class="mt-3 pb-5 my-lg-auto f-fa" style="z-index: 1">
                                        <div class="text-white" style="max-width: 550px">
                                            {!! $item->content !!}
                                        </div>

                                        <a href="{{$item->button_link}}" target="_blank">
                                            <button class="btn mt-3 mb-2 px-4 py-2" style="background: #FCE751;border-radius: 6px; color: #8E2323; font-size: 30px;font-weight: 600;">{{ $item->button }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
