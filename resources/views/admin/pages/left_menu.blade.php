<div class="panel panel-default">
    <div class="panel-heading">Страницы</div>
    <div class="panel-body">
        @foreach($pages as $page)
        <a href="{{ route('pages.edit', $page->id) }}">{{ $page->h1 }}</a><br>
        @endforeach
    </div>
</div>