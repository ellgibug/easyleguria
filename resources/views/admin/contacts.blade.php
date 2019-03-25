@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Полученные сообщения</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Данные</th>
                                <th scope="col">Сообщение</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <th scope="row">{{ $contact->id }}</th>
                                <td>
                                    {{ $contact->name }}<br>
                                    {{ $contact->email }}<br>
                                    {{ $contact->created_at }}
                                </td>
                                <td>
                                    {{ $contact->subject }}<br>
                                    {{ $contact->message }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
