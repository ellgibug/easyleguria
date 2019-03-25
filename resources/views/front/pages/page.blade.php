@extends('front.layouts.master')

@section('content')
    <div class="mg-page-title relative"
         @if($slider)
         style="background-image: url({{ asset($slider->slug) }}); background-size: cover"
            @endif
    >
        <div class="bg-overlay-dark-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->h1 }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="mg-page">
        <div class="container">
            {!! $page->body !!}
        </div>
    </div>
@endsection