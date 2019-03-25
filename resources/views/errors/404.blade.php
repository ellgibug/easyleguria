<!DOCTYPE html>
<html lang="ru">
<head>
    @include('front.partials.head')
</head>
<body>
<div class="preloader"></div>
<div class="mg-page-title relative"  style="background-image: url({{ asset('assets/images/sea.jpg') }}); background-size: cover; height: 100vh">
    <div class="bg-overlay-dark-1"></div>
    <div class="mg-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mg-404-error-txt">
                        <div class="mg-404-badg float-left"><strong>404</strong><span>ошибка</span></div>
                        <div class="mg-404-txt-search"><strong>Извините, данная страница не найдена.</strong>
                            <p>Вы можете вернуться назад или перейти на главную страницу.</p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ URL::previous() }}" class="btn btn-dark-main btn-block">Назад</a>
                                </div>
                                <div class="col-6">
                                    <a href="/" class="btn btn-dark-main btn-block">Главная страница</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.partials.scripts')
</body>
</html>