@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin.pages.left_menu')
        </div>
        <div class="col-md-9">
            @include('messages.message')
        </div>
    </div>
</div>
@endsection
