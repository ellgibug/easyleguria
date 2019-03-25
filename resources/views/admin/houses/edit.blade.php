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
                    <div class="panel-heading">Редактировать дом "{{ $house->name }}"</div>

                    <div class="panel-body">
                        @include('errors.errors')
                        <form method="post" action="{{ route('houses.update', $house->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $house->name }}" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="capacity">Количество спален</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $house->capacity }}" min="0" max="255" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="area">Площадь</label>
                                    <input type="number" class="form-control" id="area" name="area" step="0.01" value="{{ $house->area }}" min="0" max="99999999.99" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="price">Цена</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $house->price }}" min="0" max="4294967295" required>
                                </div>

                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="display" name="display" value="1" {{ $house->display ? 'checked' : '' }}>
                                <label class="form-check-label" for="display">Показывать на сайте</label>
                            </div>
                            <div class="form-group">
                                <label for="images">Добавить еще изображения</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                                <small>Для корректного отображения на сайте загружаемое изображение должно быть 1340х700 пикселей и быть горизонтальным. Допустимые форматы jpeg, jpg, png, gif</small>
                            </div>

                            <p><strong>Сущетсвующие изображения</strong></p>
                            <div class="form-group row">
                                @foreach($house->images->sortBy('priority') as $image)
                                    <div class="col-md-3 house-image-container" id="{{ $image->id }}" style="margin-bottom: 25px">
                                        <img src="{{ asset($image->slug) }}" alt="{{ $house->name }}" class="img-responsive">
                                        <label for="priority_{{ $image->id }}">Приоритет</label>
                                        <input type="number" class="form-control" id="priority_{{ $image->id }}" name="priority" value="{{ $image->priority }}" min="0" max="255">
                                        <a href="{{ route('houses.destroy', $house->id) }}" class="delete-img-from-house">Удалить</a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="summernote">Описание</label>
                                <textarea name="description" id="summernote" required>{!! \htmlspecialchars($house->description) !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="google_map">Карта</label>
                                <textarea class="form-control" name="google_map" id="google_map" rows="4" style="resize: none">{{ $house->google_map }}</textarea>
                            </div>
                            @if($house->google_map)
                                {!! $house->google_map !!}
                                <br>
                                <br>
                            @endif
                            <button type="submit" class="btn btn-default pull-left">Сохранить</button>
                        </form>

                        <form method="post" action="{{ route('houses.destroy', $house->id) }}" style="margin: 0; padding: 0">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="button" class="btn btn-default btn-group-sm pull-right" style="margin: 0"
                                    onclick='
                                                    if (confirm("Вы точно хотите удалить дом и все его изображения?")) {
                                                        $(this).closest("form").submit();
                                                    }
                                              '>Удалить</button>
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
    <script>
        $(document).ready(function () {

            $( '.delete-img-from-house' ).click(function( event ) {
                if (confirm("Вы точно хотите удалить изображение?")) {
                    var image_container = $(this).parents('.house-image-container');
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: $(this).attr('href'),
                        data: {_method: 'delete', 'image': image_container.attr('id')},
                        success: function(){
                            image_container.remove();
                            console.log('Изображение удалено');
                        },
                        error: function(){
                            alert('Ошибка! Изображение не удалено');
                        }
                    });
                }
            });

            $('input[name=priority]').change(function () {
                var image_container = $(this).parents('.house-image-container');
                event.preventDefault();
                if($(this).val() > 0 && $(this).val() < 256) {
                    $.ajax({
                        type: 'post',
                        url: $(this).parents('form').attr('action'),
                        data: {_method: 'patch', 'priority': $(this).val(), 'image': image_container.attr('id')},
                        success: function () {
                            console.log('Приоритет обновлен')
                        },
                        error: function () {
                            alert('Ошибка! Приоритет не обновлен');
                        }
                    });
                } else {
                    alert('Значение должно быть в пределах от 0 до 255');
                }
            })
        })
    </script>
@endsection