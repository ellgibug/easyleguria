@extends('admin.layouts.app')

@section('styles')
    <link href="{{ asset('dist/summernote.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin.houses.left_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить новый дом</div>

                <div class="panel-body">
                    @include('errors.errors')
                    <form method="post" action="{{ route('houses.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="capacity">Количество спален</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}"  min="0" max="255" required>
                            </div>
                            <div class="col-md-4">
                                <label for="area">Площадь</label>
                                <input type="number" class="form-control" id="area" name="area" step="0.01" value="{{ old('area') }}" min="0" max="99999999.99" required>
                            </div>
                            <div class="col-md-4">
                                <label for="price">Цена</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0" max="4294967295" required>
                            </div>

                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="display" name="display" value="1" checked>
                            <label class="form-check-label" for="display">Показывать на сайте</label>
                        </div>
                        <div class="form-group">
                            <label for="images">Добавить изображения</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple required>
                            <small>Для корректного отображения на сайте загружаемое изображение должно быть 1340х700 пикселей и быть горизонтальным. Допустимые форматы jpeg, jpg, png, gif</small>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Описание</label>
                            <textarea name="description" id="summernote" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="google_map">Карта</label>
                            <textarea class="form-control" name="google_map" id="google_map" rows="4" style="resize: none">{{ old('google_map') }}</textarea>
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
