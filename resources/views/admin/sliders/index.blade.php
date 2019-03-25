@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('messages.message')
            @include('errors.errors')
            <div class="panel panel-default">
                <div class="panel-heading">Загрузить новое изображение</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="image">Файлы</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                            <small>Для корректного отображения на сайте загружаемое изображение должно быть 1920x900 пикселей и быть горизонтальным. Допустимые форматы jpeg, jpg, png, gif</small>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="link">Ссылка</label>
                                <input type="text" class="form-control" id="link" name="link" required>
                            </div>
                            <div class="col-md-6">
                                <label for="priority">Приоритет</label>
                                <input type="number" class="form-control" id="priority" name="priority" min="0" max="255" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Сохранить</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Изображения в слайдере</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Файл</th>
                                <th scope="col">Ссылка</th>
                                <th scope="col">Приоритет</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $slider->id }}</th>
                                    <td>
                                        <a href="{{ asset($slider->slug) }}" target="_blank">
                                            <img src="{{ asset($slider->slug) }}" height="70px">
                                        </a>
                                    </td>
                                    <td><a href="{!! asset($slider->link) !!}">{!! asset($slider->link) !!}</a></td>
                                    <td>
                                        <form action="{{ route('sliders.update', $slider->id) }}">
                                            <input type="number" class="form-control" id="priority_{{ $slider->id }}" name="edit_priority" value="{{ $slider->priority }}" min="0" max="255">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('sliders.destroy', $slider->id) }}" style="margin: 0; padding: 0">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-default btn-group-sm" style="margin: 0"
                                                    onclick='
                                                    if (confirm("Вы точно хотите удалить изображение?")) {
                                                        $(this).closest("form").submit();
                                                    }
                                              '>Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Загрузок пока нет</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('input[name=edit_priority]').change(function () {
                event.preventDefault();
                if($(this).val() > 0 && $(this).val() < 256) {
                    $.ajax({
                        type: 'post',
                        url: $(this).parents('form').attr('action'),
                        data: {_method: 'patch', 'priority': $(this).val()},
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
