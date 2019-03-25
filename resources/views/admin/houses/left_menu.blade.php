<div class="panel panel-default">
    <div class="panel-heading">Дома</div>
    <div class="panel-heading"><a href="{{ route('houses.create') }}" class="btn btn-default btn-sm">Добавить новый дом</a></div>
    <div class="panel-body">
        @foreach($houses as $house)
        <a href="{{ route('houses.edit', $house->id) }}">{{ $house->name }}</a><br>
        @endforeach
    </div>
</div>