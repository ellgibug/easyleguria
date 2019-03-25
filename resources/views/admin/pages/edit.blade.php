@extends('admin.layouts.app')

@section('styles')
    <link href="{{ asset('dist/summernote.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.pages.left_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактировать страницу "{{ $page->h1 }}"</div>

                    <div class="panel-body">
                        @include('errors.errors')
                        <form method="post" action="{{ route('pages.update', $page->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="form-group">
                                <label for="h1">Заголовок</label>
                                <input type="text" class="form-control" id="h1" name="h1" value="{{ $page->h1 }}" required>
                            </div>
                            <div class="form-group">
                                <label for="summernote">Контент</label>
                                <textarea name="body" id="summernote" required>{!! \htmlspecialchars($page->body) !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Сохранить</button>
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