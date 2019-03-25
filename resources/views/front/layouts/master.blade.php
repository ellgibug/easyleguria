<!DOCTYPE html>
<html lang="ru">
<head>
    @include('front.partials.head')
</head>
<body>
<div class="preloader"></div>
@include('front.partials.menu')

@yield('content')

@include('front.partials.footer')
@include('front.partials.scripts')
</body>
</html>