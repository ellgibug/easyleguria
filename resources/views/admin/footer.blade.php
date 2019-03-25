@extends('admin.layouts.app')

@section('styles')
    <link href="{{ asset('dist/summernote.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('messages.message')

            <div class="panel panel-default">
                <div class="panel-heading">Редактирование футера</div>

                <div class="panel-body">

                    <form method="post" action="{{ route('footer.update', 1) }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <textarea name="body" id="summernote">{!! $footer->body !!}</textarea>
                        </div>

                        <button class="btn btn-md btn-default btn-center" type="submit">Сохранить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('dist/summernote.min.js') }}"></script>
    <script src="{{ asset('dist/lang/summernote-ru-RU.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
@endsection