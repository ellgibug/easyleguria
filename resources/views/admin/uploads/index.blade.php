@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('messages.message')
            @include('errors.errors')
            <div class="panel panel-default">
                <div class="panel-heading">Загрузить новый файл</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="file">Файлы</label>
                            <input type="file" class="form-control-file" id="file" name="files[]" multiple required>
                        </div>
                        <button type="submit" class="btn btn-default">Сохранить</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Загруженные файлы</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Файл</th>
                                <th scope="col">Ссылка</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($uploads as $upload)
                                <tr>
                                    <th scope="row">{{ $upload->id }}</th>
                                    <td>
                                        <a href="{{ $upload->slug }}" target="_blank">{{ $upload->slug }}</a>
                                    </td>
                                    <td>{!! asset($upload->slug) !!}</td>
                                    <td>
                                        <form method="post" action="{{ route('uploads.destroy', $upload->id) }}" style="margin: 0; padding: 0">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-default btn-group-sm" style="margin: 0"
                                                    onclick='
                                                    if (confirm("Вы точно хотите удалить файл?")) {
                                                        $(this).closest("form").submit();
                                                    }
                                              '>Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Файлов пока нет</td>
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

