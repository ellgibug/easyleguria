@extends('front.layouts.master')

@section('content')
    <div class="mg-page-title  relative"
         @if($slider)
         style="background-image: url({{ asset($slider->slug) }}); background-size: cover"
         @endif
    >
        <div class="bg-overlay-dark-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $house->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="mg-single-room" style="margin-bottom: -6px">
        <div class="container">
            <a href="{{ URL::previous() }}" class="btn btn-dark-main pull-right mb-3">Назад</a>
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                   @if(\count($house->images))
                    <div class="carousel slide" id="mega-slider" data-ride="carousel">
                        <!-- Indicators-->
                        <ol class="carousel-indicators">
                            @foreach($house->images->sortBy('priority') as $k=>$image)
                                <li class="{{ $k == 0 ? 'active' : '' }}" data-target="#mega-slider" data-slide-to="{{ $k }}"></li>
                            @endforeach
                        </ol>
                        <!-- Wrapper for slides-->
                        <div class="carousel-inner relative">

                            @foreach($house->images->sortBy('priority') as $k => $slider)
                                <div class="carousel-item  {{ $k == 0 ? 'active beactive' : '' }}">
                                    <img src="{{ asset($slider->slug) }}" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <div class="carousel-control-prev carousel-control left" href="#mega-slider" role="button" data-slide="prev"></div>
                        <div class="carousel-control-next carousel-control right" href="#mega-slider" role="button" data-slide="next"></div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-5 mg-room-fecilities">
                    <h2 class="mg-sec-left-title">Параметры</h2>
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                <li><i class="fa fa-users" aria-hidden="true"></i> Количество спален - {{ $house->capacity }}</li>
                                <li><i class="fa fa-home" aria-hidden="true"></i> Площадь - {{ $house->area }} кв.м</li>
                                <li><i class="fa fa-credit-card" aria-hidden="true"></i> Стоимость - {{ \number_format($house->price,0,'', ' ') }} &#8364;</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mg-single-room-txt">
                        <h2 class="mg-sec-left-title">Об объекте</h2>
                        {!! $house->description !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mg-single-room-txt">
                        <h2 class="mg-sec-left-title">Галерея</h2>
                        <div class="row">
                            @if(\count($house->images))
                            @foreach($house->images->sortBy('priority') as $image)
                            <figure class="col-lg-4 mg-gallery-item">
                                <a href="{{ asset($image->slug) }}" data-lightbox-gallery="rooms">
                                    <img class="img-fluid" src="{{ asset($image->slug) }}" alt="{{ $house->name }}"/>
                                    <span class="mg-gallery-overlayer"><i class="fa fa-search-plus"></i></span>
                                </a>
                            </figure>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($house->google_map)
            {!! $house->google_map !!}
        @endif
    </div>
@endsection